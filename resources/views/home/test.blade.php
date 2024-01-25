<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">

    <style>
        /* body {
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        } */

        .header_main {
            background-color: #f8f9fa;
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

        /* .header_main .menu_main ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        } */

        .header_main .menu_main li {
            margin-right: 20px;
            white-space: nowrap;
        }

        .header_main .menu_main a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 16px;
        }

        /* .header_main .menu_main .active {
            color: #DB6574;  Set the color for active menu item
        } */
    </style>


</head>

<body>
    <div class="header_main">
        <div class="container-fluid">
            {{-- <div class="logo">
                <a href="/"><img src="images/logo.png" height="90px" width="90px"></a>
            </div>
            <div class="menu_main">
                <ul>
                    <li class="active"><a href="/">Home</a></li>
                    <li class="active"><a href="">About</a></li>
                    <li class="active"><a href="">Blog</a></li>

                    @if (Route::has('login'))
                        @auth
                        <li class="active"><a href={{ url('create_post') }}>Create Post</a></li>
                    <li class="active"><a href={{ url('my_posts') }}>My Posts</a></li>
                            <li class="active">
                                <x-app-layout>
                                </x-app-layout>
                            </li>
                        @else
                            <li class="active"><a href="{{ route('login') }}">Login</a></li>
                            <li class="active"><a href="{{ route('register') }}">Register</a></li>
                        @endauth
                    @endif
                </ul>
            </div> --}}

             @if (Route::has('login'))
        @auth
            <div class="header_main">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <a href="/"><img src="images/logo.png" height="90px" width="90px"></a>
                    </div>
                    <div class="menu_main" id="w">
                        <ul>
                            <li class="active"><a href="/">Home</a></li>
                            <li class="active"><a href="{{ url('about_read_more') }}">About</a></li>
                            <li class="active"><a href="{{ url('blogs') }}">Blog</a></li>
                            @if(Auth::user()->userType == 'user')
                                <li class="active"><a href="{{ url('create_post') }}">Create Post</a></li>
                                <li class="active"><a href="{{ url('my_posts') }}">My Posts</a></li>
                            @elseif(Auth::user()->userType == 'admin')
                                <!-- Add admin-specific menu items here -->
                                <li class="active"><a href="{{ url('home') }}">Admin Dashboard</a></li>
                            @endif
                            <li class="active" >
                                <x-app-layout>
                                </x-app-layout>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="logo"><a href="/"><img src="images/logo.png" height="90px" width="90px"></a></div>
            <div class="menu_main">
                <ul>
                    <li class="active"><a href="/">Home</a></li>
                    <li class="active"><a href="{{ url('about_read_more') }}">About</a></li>
                    <li class="active"><a href="{{ url('blogs') }}">Blog</a></li>
                    <li class="active"><a href="{{ route('login') }}">Login</a></li>
                    <li class="active"><a href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        @endauth
    @endif
        </div>
    </div>

</body>

</html>
