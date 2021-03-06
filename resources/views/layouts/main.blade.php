<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Home - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        {{ Html::style('/css/styles.css') }}
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <style>
            .btnsubmit {
                background-color: rgb(0, 110, 255);
                padding: 5px;
            }
            .dropbtn {
              background-color: #212529;
              color: rgba(255, 255, 255, 0.55);
              padding: 8px;
              font-size: 16px;
              border: none;
              cursor: pointer;
            }
            
            .dropdown {
              position: relative;
              display: inline-block;
            }
            
            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f9f9f9;
              min-width: 160px;
              box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
              z-index: 1;
            }
            
            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }
            
            .dropdown-content a:hover {background-color: #f1f1f1}
            
            .dropdown:hover .dropdown-content {
              display: block;
            }
            
            .dropdown:hover .dropbtn {
                color: #C7C8C9;
            }
        </style>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
            <div class="container">
                <a class="navbar-brand" href="#!">Laravel 8 Blog CMS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                        @auth
                            <div class="dropdown">
                                <button class="dropbtn">{{ auth()->user()->name }}</button>
                                <div class="dropdown-content">
                                    @if(auth()->user()->admin == 1)
                                        <a href="{{ url('/users') }}">Admin Dashboard</a>
                                    @endif
                                    <a href="{{ url('/users/' . auth()->user()->id . '/edit') }}">Change Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit()">Logout</a>
                                    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            
                        @else
                            <div class="dropdown">
                                <button class="dropbtn">Username</button>
                                <div class="dropdown-content">
                                    <a href="{{ route('login') }}">Login</a>
                                    <a href="{{ route('register') }}">Register</a>
                                </div>
                            </div>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @if(!Route::is('login') && !Route::is('register') && !Route::is('users.edit'))
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    @yield('content')
                    @if(!Route::is('posts.show'))
                        <!-- Pagination-->
                        <div class="mb-3">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            {{ Form::open(['url' => '/store/search', 'method' => 'get', 'class' => 'form-group']) }}
                            <div class="input-group">
                                {{ Form::text('search', null, array('placeholder' => "Enter search term...", "class" => "form-control")) }}
                                {{ Form::submit('Go!', array('class' => 'btnsubmit')) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($categories as $category)
                                            <li><a href="{{ url('/store/categories/'. $category->id . '/posts') }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
        </div>
        @else
            @yield('content')
        @endif
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        {{ Html::script('/js/bootstrap.bundle.min.js') }}
        <!-- Core theme JS-->
        {{ Html::script('/js/scripts.js') }}
    </body>
</html>
