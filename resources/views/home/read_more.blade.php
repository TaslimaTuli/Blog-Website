<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homeCss')
</head>

<body>
    @include('home.test')
    {{-- <div class="header_section">
        @include('home.homeHeader')

    </div> --}}
    <div class="blog_content">
        {{-- <div><img src="/postImage/{{ $data->image }}" alt=""></div> --}}
        @if ($data->image)
            <div><img src="/postImage/{{ $data->image }}" ></div>
        @else
            <div><img src="/postImage/no-image.png"></div>
        @endif
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
