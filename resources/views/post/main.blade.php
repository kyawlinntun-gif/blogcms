@extends('admin.main')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Post Control</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">View All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/posts/create') }}">Create New Post</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if(Session::has('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <em>{{ Session::get('info') }}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (count($posts) > 0)

        <div class="panel">
            <div class="panel-heading">All Posts</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col">Image</th>
                            <th scope="col" colspan="3">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)    
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->author }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ Html::image('/img/posts/'. $post->image, $post->title                    , ['width' => 60]) }}</td>
                                <td>{{ $post->short_desc }}</td>
                                <td><a href="{{ url('/posts/' . $post->id . '/edit') }}">Edit</a></td>
                                <td>
                                    <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('{{'post'. $post->id }}').submit();">Delete</button>
                                    {{ Form::open(['url' => 'posts/' . $post->id, 'method' => 'delete', 'class' => 'd-none', 'id' => 'post' . $post->id]) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif

@endsection
