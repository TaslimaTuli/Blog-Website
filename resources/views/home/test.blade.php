<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">

    <style>
        .header_main {
            padding: 10px 0;
        }

        .header_main .container-fluid {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header_main .logo img {
            max-height: 100px;
            width: auto;
        }

        .header_main .menu_main ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .header_main .menu_main li {
            margin-right: 20px;
            white-space: nowrap;
        }

        .header_main .menu_main a {
            text-decoration: none;
            color: #333;
            /* font-weight: bold; */
            font-size: 16px;
        }


    </style>


</head>

<body>
    <div class="header_main">
        <div class="container-fluid">
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="logo"><a href="/"><img src="images/logo.png" height="90px" width="90px"></a></div>
                <div class="menu_main">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                        <li class="{{ Request::is('about_read_more') ? 'active' : '' }}"><a
                                href="{{ url('about_read_more') }}">About</a></li>
                        <li class="{{ Request::is('blogs') ? 'active' : '' }}"><a href="{{ url('blogs') }}">Blog</a>
                        </li>
                        @auth
                            @if (Auth::user()->userType == 'user')
                                <li class="{{ Request::is('create_post') ? 'active' : '' }}"><a
                                        href="{{ url('create_post') }}">Create Post</a></li>
                                <li class="{{ Request::is('my_posts') ? 'active' : '' }}"><a href="{{ url('my_posts') }}">My
                                        Posts</a></li>
                            @elseif(Auth::user()->userType == 'admin')
                                <li><a href="{{ url('home') }}">Admin Dashboard</a></li>
                            @endif
                            <li>
                                <x-app-layout>
                                </x-app-layout>
                            </li>
                        @else
                            <li class="{{ Request::is('create_post') ? 'active' : '' }}"><a
                                    href="{{ route('login') }}">Create
                                    Post</a></li>
                            <li class="{{ Request::is('login') ? 'active' : '' }}"><a
                                    href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="{{ Request::is('register') ? 'active' : '' }}"><a
                                    href="{{ route('register') }}">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
