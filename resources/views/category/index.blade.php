@extends('admin.main')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Category Control</h1>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">View All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/categories/create') }}">Create New Category</a>
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

    @if (count($categories) > 0)

        <div class="panel">
            <div class="panel-heading">All Categories</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td><a href="{{ url('/categories/' . $category->id . '/edit') }}">Edit</a></td>
                                <td>
                                    <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('{{'category'. $category->id }}').submit();">Delete</button>
                                    {{ Form::open(['url' => 'categories/' . $category->id, 'method' => 'delete', 'class' => 'd-none', 'id' => 'category' . $category->id]) }}
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
