{{-- <div class="header_main"> --}}
{{-- <div class="mobile_menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="logo_mobile"><a href="/"><img src="images/logo.png" height="10px" width="10px"></a></div>
            <div></div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " href="">Blog</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="active">
                                <x-app-layout>
                                </x-app-layout>

                            </li>
                        @else
                            <li><a href={{ route('login') }}>Login</a></li>
                            <li><a href={{ route('register') }}>Register</a></li>

                        @endauth
                    @endif

                </ul>
            </div>
        </nav>
    </div> --}}

{{-- pc view --}}
{{--
    <div class="container-fluid">
        <div class="logo"><a href="/"><img src="images/logo.png" height="100px" width="100px"></a>
        </div>
        <div class="menu_main">
            <ul>
                <li class="active"><a href="/">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="blog.html">Blog</a></li>
                @if (Route::has('login'))
                    @auth
                        <li class="active">
                            <x-app-layout>
                            </x-app-layout>

                        </li>
                    @else
                        <li><a href={{ route('login') }}>Login</a></li>
                        <li><a href={{ route('register') }}>Register</a></li>

                    @endauth
                @endif
            </ul>
        </div>
    </div>
 </div> --}}

{{-- PC --}}

<div class="header_main">
    <div class="container-fluid">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="logo"><a href="/"><img src="images/logo.png" height="90px" width="90px"></a></div>

            <div class="menu_main">
                <ul>
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                    <li class="{{ Request::is('about_read_more') ? 'active' : '' }}"><a href="{{ url('about_read_more') }}">About</a></li>
                    <li class="{{ Request::is('blogs') ? 'active' : '' }}"><a href="{{ url('blogs') }}">Blog</a></li>
                    @auth
                        @if (Auth::user()->userType == 'user')
                            <li class="{{ Request::is('create_post') ? 'active' : '' }}"><a href="{{ url('create_post') }}">Create Post</a></li>
                            <li class="{{ Request::is('my_posts') ? 'active' : '' }}"><a href="{{ url('my_posts') }}">My Posts</a></li>
                        @elseif(Auth::user()->userType == 'admin')
                            <li><a href="{{ url('home') }}">Admin Dashboard</a></li>
                        @endif
                        <li>
                            <x-app-layout>
                            </x-app-layout>
                        </li>
                    @else
                        <li class="{{ Request::is('create_post') ? 'active' : '' }}"><a href="{{ route('login') }}">Create Post</a></li>
                        <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
                        <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>

