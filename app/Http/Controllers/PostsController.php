<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class PostsController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct()
	// {
	// 	$this->middleware('auth', ['except' => ['index', 'show']]);
	// }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// $posts = Post::all();
		$posts = Post::orderBy('created_at', 'desc')->paginate(10);
		return view('posts.index', ['posts' => $posts]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'cover_image' => 'image|nullable|max:1999'
		]);

		if($request->hasFile('cover_image')) {
			// Get filename with extension
			$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
			// Get just filename
			$fname = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get just the extension
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			// File name to store
			$fileNameToStore = $fname . '_' . time() . '.' . $extension; // Unique name for each file
			// Upload image
			$path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
		} else {
			$fileNameToStore = 'no_image.png';
		}

		$post = new Post;
		$post->title = $request->input('title');
		$post->body = $request->input('body');
		$post->user_id = auth()->user()->id;
		$post->cover_image = $fileNameToStore;
		$post->save();

		return redirect('/posts')->with('success', 'Post created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$post = Post::find($id);
		return view('posts.show', ['post' => $post]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$post = Post::find($id);
		return view('posts.edit', ['post' => $post]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'title' => 'required',
			'body' => 'required',
			'cover_image' => 'image|nullable|max:1999'
		]);

		if($request->hasFile('cover_image')) {
			// Get filename with extension
			$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
			// Get just filename
			$fname = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get just the extension
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			// File name to store
			$fileNameToStore = $fname . '_' . time() . '.' . $extension; // Unique name for each file
			// Upload image
			$path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
		}

		$post = Post::find($id);
		$post->title = $request->input('title');
		$post->body = $request->input('body');
		// Delete the old image if the image was updated
		if($request->hasFile('cover_image')) {
			// Not deleting if the img is no_image
			if ($post->cover_image != 'no_image.png') {
				// Test if the file exists, then delete it if true
				if(Storage::disk('public')->exists("cover_images/{$post->cover_image}")) {
					Storage::delete('public/cover_image/' . $post->cover_image);
				}
			}
			$post->cover_image = $fileNameToStore;
		}
		$post->save();

		return redirect('/posts')->with('success', 'Post updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);

		if($post->cover_image != 'no_image.png') {
			Storage::delete('public/cover_image/' . $post->cover_image);
		}
		$post->delete();

		return redirect('/posts')->with('success', 'Post removed');
	}
}