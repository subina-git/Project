<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class=" d-flex collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">All Blogs</a>
                </li>
                @if(!Auth::guest())
                    <li class="nav-item">
                        <a class="nav-link" href="/posts/create">Add Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/myblog">My Blogs</a>
                    </li>
                @endif
                
                
            </ul>
        </div>
        <div class="d-flex justify-content-between">
            <ul class="navbar-nav mr-auto">
                @if(Auth::guest())
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Sign Up</a>
                </li>
                @endif
                @if(!Auth::guest())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{auth()->user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/home">Dashboard</a>
                            <a  class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

</nav>
