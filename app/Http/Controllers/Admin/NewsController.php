<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Services\UploadedService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    /*	dd(
    		\DB::table('news')->join('categories',
			'news.category_id', '=', 'categories.id')
			->select("news.*", 'categories.title as categoryTitle')
			->where('news.author', 'like', '%'. $request->query('author') .'%')
			->where('news.status', '<>', 'DRAFT')
			->orWhere('news.id', '>', 8)
			->whereNotIn('news.id', [1, 7])
			->orderBy('news.author', 'desc')
		    ->get()
		);
        */

    	$newsList = News::with('category')
			->paginate(config('paginate.admin.news'));
		return view('admin.news.index', [
			'newsList' => $newsList
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
	{
		$categories = Category::all();
        return view('admin.news.create', [
        	'categories' => $categories
		]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreNewsRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(StoreNewsRequest $request)
    {
    	$news = News::create($request->validated());

		if($news) {
			return redirect()->route('admin.news.index')
				->with('success', __('messages.admin.news.create.success'));
		}

		return back()->withInput()->with('error', __('messages.admin.news.create.fail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param News $news
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function edit(News $news)
    {
    	$categories = Category::all();
        return view('admin.news.edit', [
        	'news' => $news,
			'categories' => $categories
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UpdateNewsRequest $request
	 * @param News $news
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(UpdateNewsRequest $request, News $news)
    {
		$validated = $request->validated();
		if($request->hasFile('image')) {
			$uploadedService = app(UploadedService::class);
			$validated['image'] = $uploadedService->fileUpload(
				$request->file('image')
			);
		}

		$news = $news->fill($validated)->save();

		if($news) {
			return redirect()->route('admin.news.index')
				->with('success', __('messages.admin.news.update.success'));
		}

		return back()->withInput()->with('error', __('messages.admin.news.update.fail'));
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param News $news
	 * @return \Illuminate\Http\JsonResponse
	 */
    public function destroy(Request $request, News $news)
    {
      if($request->ajax()) {
		  try {
			  $news->delete();
			  return response()->json('ok');

		  } catch (\Exception $e) {
             \Log::error($e->getMessage());

             return response()->json('error', 400);
		  }
	  }
    }
}
