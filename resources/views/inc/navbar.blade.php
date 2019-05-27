<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link" href=" {{url('/home')}} ">
                    <i class="fa fa-home"></i>
                    Sessions
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('posts') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/posts')}}">
                    <i class="fa fa-envelope-o">
                        <span class="badge badge-danger">{{ 'App\Post'::count() }}</span>
                    </i>
                    Posts
                </a>
            </li>
            <li class="nav-item {{ Request::is('contests') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/contests')}}">
                    <i class="fa fa-envelope-o">
                        <span class="badge badge-danger">{{ 'App\Problem'::count()}} </span>
                    </i>
                    Contests
                </a>
            </li>
            <li class="nav-item {{ Request::is('problemset') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/home')}}">
                    <i class="fa fa-envelope-o">
                        <span class="badge badge-danger">{{ 'App\Problem'::count()}} </span>
                    </i>
                    Problemset
                </a>
            </li>
            </li>
            <li class="nav-item {{ Request::is('compiler') ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/compiler')}}">
                    <i class="fa fa-cogs">
                        {{-- <span class="badge badge-danger">{{ 'App\Problem'::count()}} </span> --}}
                    </i>
                    Compiler
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-bell">
                        <span class="badge badge-info">11</span>
                    </i>
                    Disabled
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-globe">
                        <span class="badge badge-success">11</span>
                    </i>
                    Disabled
                </a>
            </li>
        </ul>

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" data-target="target">{{'\Auth'::user()->name}}
                <span class="caret"></span></button>
            <div class="dropdown-menu" aria-labelledby="target">
                <a class="dropdown-item" href="/myprofile">My Profile</a>
                <a class="dropdown-item" href="/mysubmissions">Submissions</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            </ul>
        </div>
</nav> 