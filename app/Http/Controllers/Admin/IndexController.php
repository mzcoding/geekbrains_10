<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
	{
		return view('admin.index', [
			'countNews' => count($this->newsList),
			'countCategories' => 0
		]);
	}
}
