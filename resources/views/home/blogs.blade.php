<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            display: block;
            margin: 0 auto; /* Center the image horizontally */
            max-width: 40%;
            height: auto;
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

        .action-buttons {
            margin-top: 20px;
            text-align: center;
        }

        /* .action-buttons button {
            margin: 0 10px;
            padding: 10px;
            font-size: 16px;
        }

        .action-buttons button.delete {
            background-color: #dc3545;
            color: white;
        }

        .action-buttons button.update {
            background-color: #007bff;
            color: white;
        } */

        .pending-status {

        color: red;
        text-align: right;
        margin-left: auto; /* Aligns the entire element to the right */
        font-weight: bold;
        /* padding: 5px 10px;
        border-radius: 5px; */
    }

    </style>
</head>

<body>
    @include('sweetalert::alert')
    @include('home.test')
    @foreach ($data->reverse() as $data)
        <div class="blog_content">
            @if ($data->status === 'Pending')
            <p class="pending-status">{{ $data->status }}</p>
        @endif
            <div><img src="/postImage/{{ $data->image }}" alt=""></div>
            <h1>{{ $data->title }}</h1>
            <h2>{{ $data->description }}</h2>

            @php
            // Convert timestamp to Carbon instance
            $createdAt = \Carbon\Carbon::parse($data->created_at);
            @endphp

             <p class="posted-by">- Posted by <span style="font-weight:bold;">{{ $data->name }}</span>
                 at {{ $createdAt->toFormattedDateString() }}
                {{ $createdAt->format('h:i A') }}</p>
            {{-- <p class="posted-by"> - Posted by {{ $data->name }} at {{ $data->created_at}}</p> --}}

        </div>
    @endforeach
    @include('home.footer')

    <script>

    </script>
</body>

</html>
