<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homeCss')
    <style>
        body {
            /* font-family: 'Arial', sans-serif; */
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;

        }

        .blog_content {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);


        }

        .blog_content img {
            /* max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px; */
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 5px;
            margin-bottom: 20px;

        }

        .blog_content h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 10px;
        }

        .blog_content h2 {
            font-size: 24px;
            color: #555;
            margin-bottom: 20px;
        }

        .posted-by {
            color: #777;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>

</head>

<body>
    @include('home.test')
    {{-- <div class="header_section">
        @include('home.homeHeader')

    </div> --}}
    <div class="blog_content">
        <div><img src="/postImage/{{ $data->image }}" alt=""></div>
        <h1>{{ $data->title }}</h1>
        <h2>{{ $data->description }}</h2>
        @php
            // Convert timestamp to Carbon instance
            $createdAt = \Carbon\Carbon::parse($data->created_at);
        @endphp
        <p class="posted-by">- Posted by <span style="font-weight:bold;">{{ $data->name }}</span> at
            {{ $createdAt->toFormattedDateString() }} ,
            {{ $createdAt->format('h:i A') }}</p>
        {{-- <p class="posted-by"> - Posted by {{ $data->name }}</p> --}}
    </div>
    @include('home.footer')
</body>

</html>
