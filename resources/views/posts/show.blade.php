@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-info btn-sm"><-Go back</a>
<br><br>
<div class="container">
	<h1>{{ $post['title'] }}</h1>
	<img style="max-width: 100%" src="/storage/cover_image/{{ $post['cover_image'] }}" />
	<div class="p-2" style="word-wrap:break-word !important; overflow-wrap:break-word !important;">
		{!! $post['body'] !!}
	</div>
	<hr>
	<small>written on {{ $post['created_at'] }} by <i>{{ $post->user['name'] }}</i></small> <br>
</div>
{{-- <a href="/posts/{{ $post['id'] }}/edit" class="btn btn-success">Edit</a>

{!! Form::open(['action'=>['PostsController@destroy', $post['id']], 'method'=>'POST', 'class'=>'float-right']) !!}
	{{ Form::hidden('_method', 'DELETE') }}
	{{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
{!! Form::close() !!} --}}

@endsection