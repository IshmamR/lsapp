@extends('layouts.app')

@section('content')
{{-- <?php echo $posts;
die(); ?> --}}
	<h1>POSTS</h1>
	@if(count($posts) > 0)
		@foreach($posts as $post)
			<div class="well shadow">
				<div class="row">
					<div class="col-md-4 col-sm-4 preview">
						<img style="width:100%;height:100%;object-fit:cover;" src="/storage/cover_image/{{ $post['cover_image'] }}" />
					</div>
					<div class="col-md-8 col-sm-8">
						<div class="p-3">
							<h3>
								<a href="/posts/{{ $post['id'] }}"> {{ $post['title'] }} </a>
							</h3>
							<div style="overflow-wrap: break-word;">
								{!! Str::limit($post->body, 95, '...') !!}
							</div>
							<small>
								written on {{$post->created_at}} by <i>{{$post->user['name']}}</i>
							</small>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{{ $posts->links() }}
	@else
		<h1>No posts to show</h1>
	@endif
@endsection