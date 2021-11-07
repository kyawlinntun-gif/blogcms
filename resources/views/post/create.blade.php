@extends('admin.main')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create New Post</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/posts') }}">View All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Create New Post</a>
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

    <div class="panel panel-default">

        {{-- ---------- Start of Form Errors ---------- --}}
        @include('common.errors')
        {{-- ---------- End of Form Errors ---------- --}}

        <div class="panel-body">
            {{ Form::open(['url' => 'posts', 'method' => 'post', 'files' => true]) }}

            <div class="form-group">
                {{ Form::label('category_id', 'Category Name') }} <br>
                {{ Form::select('category_id', $categories, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Post Title') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('author', 'Author') }}
                {{ Form::text('author', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('image', 'Image') }} <br>
                {{ Form::file('image', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('short_desc', 'Short Description') }}
                {{ Form::text('short_desc', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description') }}
                {{ Form::textarea('description', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Create post') }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection
