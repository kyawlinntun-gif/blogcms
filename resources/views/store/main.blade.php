@extends('layouts.main')

@section('content')
    @foreach($posts as $post)
        <div class="card mb-4">
            {{ Html::image('/img/posts/'. $post->image, $post->title, array('styles' => 'width: 850px; height: 350px')) }}
            <div class="card-body">
                <div class="small text-muted">Posted on <em>{{ $post->updated_at->diffForHumans() }}</em> by <b>{{ $post->author }}</b></div>
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">{{ $post->short_desc }}</p>
                <a class="btn btn-primary" href="#!">Read more →</a>
            </div>
        </div>
    @endforeach
@endsection
