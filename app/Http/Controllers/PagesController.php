<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function index() {
		$title = 'Welcome to Laravel!';
		return view('pages.index', ['title' => $title]); // Using dynamic title
	}

	public function about() {
		$title = 'About us';
		return view('pages.about', compact('title')); // Using dynamic title(in differnt style)
	}

	public function services() {
		$data = array(
			'title' => 'Services',
			'services' => ['Web design', 'Web development', 'Programming', 'SEO']
		);
		return view('pages.services')->with($data);
	}
}
