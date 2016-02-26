@extends('layouts.app')

@section('content')
<div class="container" role="main">
	<div class="header">
        Your Blog
    </div>
  
    @if (count($posts) > 0)
    	<!-- banners, ads, etc, can go here -->
		@foreach ($posts as $post)
		    <div class="sectioning-1">
		        <div class="lead"><a href="/blog/{{ date('Y-m-d', strtotime($post->updated_at)) }}/{{ $post->slug }}">{{ $post->title }}</a></div>
				<div class="date-badge">
					<div><p><span class="label label-default label-color-mod">{{ $post->created_at }}</span></p></div>
				</div>
				<div class="author">
					<div><p>Posted By: {{ $post->author }}</p></div>
				</div>
				<div class="tags">
					<div><p>
						@foreach (explode(",", $post->tags) as $tag)
							<span class="label label-default tag-color-mod">{{ $tag }}</span>
						@endforeach
					</p></div>
				</div>
				<div class="post-body">
					<div>{!! $post->body !!}</div>
				</div>
		    </div>
		@endforeach
	@endif
</div>
@endsection


