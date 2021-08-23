<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
	{
		$categories = Category::orderBy('id', $request->query('sort', 'asc'))
			->paginate(config('paginate.admin.categories'));

        return view('admin.news.categories.index', [
        	'categories' => $categories
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
		return view('admin.news.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
	 */
    public function store(Request $request)
    {
        $category = Category::create(
			$request->only(['title', 'description'])
		);

        if($category) {
        	return redirect()->route('admin.categories.index')
				->with('success', 'Категория успешно добавлена');
		}

        return back()->withInput()->with('error', 'Не удалось добавть категорию');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Category $category
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
	 */
    public function edit(Category $category)
    {
        return view('admin.news.categories.edit', [
        	'category' => $category
		]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Category $category
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, Category $category)
    {


		/*$category->title = $request->input('title');
		$category->description = $request->input('description');
		$category = $category->save();*/

		$category = $category->fill(
			$request->only(['title', 'description'])
		)->save();

		if($category) {
			return redirect()->route('admin.categories.index')
				->with('success', 'Категория успешно сохранена');
		}
		return back()->withInput()->with('error', 'Не удалось сохранить категорию');

    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Category $category
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(Category $category)
    {
        //
    }
}
