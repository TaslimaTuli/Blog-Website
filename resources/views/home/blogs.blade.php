<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <base href="/public">
    @include('home.homeCss')
</head>

<body>
    @include('sweetalert::alert')
    @include('home.test')
    @foreach ($data->reverse() as $data)
        <div class="blog_content">
            {{-- @if ($data->status === 'Pending')
                <p class="pending-status">{{ $data->status }}</p>
            @endif --}}
            {{-- <div><img src="/postImage/{{ $data->image }}" alt=""></div> --}}
            @if ($data->image)
                <div><img src="/postImage/{{ $data->image }}"></div>
            @else
                <div><img src="/postImage/no-image.png"></div>
            @endif
            @php
                // Convert timestamp to Carbon instance
                $createdAt = \Carbon\Carbon::parse($data->created_at);
            @endphp
            <h1>{{ $data->title }}</h1>
            <h2>{{ $data->description }}</h2>
            <p class="posted-by">- Posted by <span style="font-weight:bold;">{{ $data->name }} .</span>
                 {{ $createdAt->diffForHumans() }} </p>
                {{-- at {{ $createdAt->toFormattedDateString() }}
                {{ $createdAt->format('h:i A') }}</p> --}}
            {{-- <p class="posted-by"> - Posted by {{ $data->name }} at {{ $data->created_at}}</p> --}}

        </div>
    @endforeach
    @include('home.footer')

    <script></script>
</body>

</html>
