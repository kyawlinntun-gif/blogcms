@extends('layouts.main')

@section('content')
    <h1 class="mb-4">AIT Computer 
        <small style="color: gray; font-size: 2rem">Leading e-Learning in Myanmar</small>
    </h1>
    <!-- Featured blog post-->
    @foreach($posts as $post)
        <div class="card mb-4">
            <a href="{{ url('/store/posts/'. $post->id) }}">{{ Html::image('/img/posts/'. $post->image, $post->title, array('style' => 'width: 827.33px; height: 458.75px;')) }}</a>
            <div class="card-body">
                <div class="small text-muted">Posted on <em>{{ $post->updated_at->diffForHumans() }}</em> by <b>{{ $post->author }}</b></div>
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">{{ $post->short_desc }}</p>
                <a class="btn btn-primary" href="{{ url('/store/posts/'. $post->id) }}">Read more →</a>
            </div>
        </div>
    @endforeach
@endsection
