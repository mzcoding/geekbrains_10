<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
	{
		// show news list

		$news = News::all();
		return view('news.index', [
			'newsList' => $news
		]);
	}

	public function show(News $news)
	{
		return view('news.show', [
			'news' => $news
		]);
	}
}
