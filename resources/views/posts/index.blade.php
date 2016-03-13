@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-offset-1 col-sm-10">
			<div class="panel panel-default">
				@if ($single_post)
				<div class="panel-heading">
					Update Post
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Post Form -->
					<form action="/post/{{ $single_post->id }}" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						{{ method_field('PUT') }}

						<!-- Post Name --><!-- -->
						<div class="form-group">
							<label for="post-title" class="col-sm-3 control-label">Title</label>

							<div class="col-sm-6">
								<input type="text" name="title" id="post-title" class="form-control" value="{{ $single_post->title }}">
							</div>
						</div>

						<!-- Post Body -->
						<div class="form-group">
							<label for="post-body" class="col-sm-3 control-label">Body</label>

							<div class="col-sm-6">
								<textarea rows="5" name="body" id="post-body" class="form-control">{!! $single_post->body !!}</textarea>
							</div>
						</div>

						<!-- Post Tags -->
						<div class="form-group">
							<label for="post-tags" class="col-sm-3 control-label">Tags</label>

							<div class="col-sm-6">
								<input type="text" name="tags" id="post-tags" class="form-control" value="{{ $single_post->tags }}">
							</div>
						</div>

						<!-- Post Release Date -->
						<div class="form-group">
							<label for="post-release_at" class="col-sm-3 control-label">Release Date</label>

							<div class="col-sm-6">
								<input type="text" name="release_at" id="post-release_at" class="form-control" value="{{ $single_post->release_at }}">
							</div>
						</div>

						<!-- Update Post Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i>Update Post
								</button>
							</div>
						</div>
					</form>
				</div>
				@else
				<div class="panel-heading">
					New Post
				</div>

				<div class="panel-body">
					<!-- Display Validation Errors -->
					@include('common.errors')

					<!-- New Post Form -->
					<form action="/post" method="POST" class="form-horizontal">
						{{ csrf_field() }}

						<!-- Post Name -->
						<div class="form-group">
							<label for="post-title" class="col-sm-3 control-label">Title</label>

							<div class="col-sm-6">
								<input type="text" name="title" id="post-title" class="form-control" value="{{ old('post') }}">
							</div>
						</div>

						<!-- Post Body -->
						<div class="form-group">
							<label for="post-body" class="col-sm-3 control-label">Body</label>

							<div class="col-sm-6">
								<textarea rows="5" name="body" id="post-body" class="form-control">{{ old('body') }}</textarea>
							</div>
						</div>

						<!-- Post Tags -->
						<div class="form-group">
							<label for="post-tags" class="col-sm-3 control-label">Tags</label>

							<div class="col-sm-6">
								<input type="text" name="tags" id="post-tags" class="form-control" value="{{ old('tags') }}">
							</div>
						</div>

						<!-- Post Release Date -->
						<div class="form-group">
							<label for="post-release_at" class="col-sm-3 control-label">Release Date</label>

							<div class="col-sm-6">
								<input type="text" name="release_at" id="post-release_at" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>">
							</div>
						</div>

						<!-- Add Post Button -->
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-6">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-btn fa-plus"></i>Add Post
								</button>
							</div>
						</div>
					</form>
				</div>
				@endif
			</div>

			<!-- Current Posts -->
			@if (count($posts) > 0)
				<div class="panel panel-default">
					<div class="panel-heading">
						Current Posts
					</div>

					<div class="panel-body">
						<table class="table table-striped post-table">
							<thead>
								<th>Post Title</th>
								<th>Author</th>
								<th>Date Posted</th>
								<th>&nbsp;</th>
								<th>&nbsp;</th>
							</thead>
							<tbody>
								@foreach ($posts as $post)
									<tr>
										<td class="table-text add-middle"><div>{{ $post->title }}</div></td>
										<td class="table-text add-middle"><div>{{ $post->author }}</div></td>
										<td class="table-text add-middle"><div>{{ $post->created_at }}</div></td>
										<td>
											<!-- Post Edit Button -->
											<form class="inline-table-form-button" action="/post/{{ $post->id }}/edit" method="GET">
												{{ csrf_field() }}
												
												<button type="submit" id="edit-post-{{ $post->id }}" class="btn btn-info btn-sm">
													<i class="fa fa-btn fa-pencil"></i>Edit
												</button>
											</form>
										</td>
										<td>
											<!-- Post Delete Button -->
											<form class="inline-table-form-button" action="/post/{{ $post->id }}" method="POST">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}

												<button type="submit" id="delete-post-{{ $post->id }}" class="btn btn-danger btn-sm">
													<i class="fa fa-btn fa-trash"></i>Delete
												</button>
											</form>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
