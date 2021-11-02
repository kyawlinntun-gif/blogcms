@extends('admin.main')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create New Category</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/categories') }}">View All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Create New Category</a>
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
            {{ Form::open(['url' => 'categories', 'method' => 'post']) }}
            <div class="form-group">
                {{ Form::label('name', null, ['class' => 'control-label']) }}
                {{ Form::text('name', null, array_merge(['class' => 'form-control'])) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Create category') }}
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection
