@guest
	<?php header('Location: /login'); exit(); ?>
@endguest

@auth
@extends('layouts.app')

@section('content')

<h1>Edit post</h1>

{!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
	<div class="form-group">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>'Title']) }}
	</div>
	<div class="form-group">
		{{ Form::label('body', 'Body') }}
		{{ Form::textarea('body', $post->body, ['class'=>'form-control', 'id'=>'editor']) }}
	</div>
	<div class="form-group">
		{{ Form::label('cover_image', 'Featured Image:') }}
		{{ Form::file('cover_image') }}
	</div>
	{{ Form::hidden('_method', 'PUT') }}
	{{ Form::submit('Update', ['class'=>'btn btn-primary']) }}
{!! Form::close() !!}

{{-- CKEDITOR CDN --}}
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
	window.addEventListener('load', function() {
		CKEDITOR.replace( 'editor' );
	})
</script>
{{-- CKEDITOR END --}}
@endsection
@endauth