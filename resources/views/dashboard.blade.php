@extends('layouts.app')

@section('content')
{{-- <?php echo ($user['post']);
die(); ?>
 --}}<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				{{-- <div class="card-header">{{ __('Dashboard') }}</div>
				
				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					
					{{ __('You are logged in!') }}
				</div> --}}

				<div class="card-header">
					<h3>Dashboard</h3>
				</div>
				<div class="card-body">
					<a href="/posts/create" class="btn btn-primary mb-3">Create possts</a>
					<h3>Your Blog Posts</h3>
					<table class="table table-hover table-responsive">
						<thead style="width: 100%">
							<tr>
								<th scope="col" style="width: 100%">Title</th>
								<th colspan="2" scope="col">Actions</th>
							</tr>
						</thead>
						@if(count($posts) > 0)
						<tbody>
						@foreach($posts as $post)
						<tr>
							<td>{{ $post->title }}</td>
							<td>
								<a href="/posts/{{ $post->id }}/edit" class="btn btn-success">Edit</a>
							</td>
							<td>
								{!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right']) !!}
									{{ Form::hidden('_method', 'DELETE') }}
									{{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
								{!! Form::close() !!}
							</td>
						</tr>
						@endforeach
						</tbody>
						@endif
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
