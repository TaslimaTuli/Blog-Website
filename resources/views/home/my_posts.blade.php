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
            @if ($data->status === 'Pending')
            <p class="pending-status">{{ $data->status }}</p>
        @endif
            {{-- <div><img src="/postImage/{{ $data->image }}" alt=""></div> --}}
             @if ($data->image)
                <div><img src="/postImage/{{ $data->image }}"></div>
            @else
                <div><img src="/postImage/no-image.png"></div>
            @endif
            <h1>{{ $data->title }}</h1>


            {{-- @if ($data->status ==  'Pending')
                <p>{{ $data->status }}</p>
            @endif --}}
            <h2>{{ $data->description }}</h2>
            @php
                // Convert timestamp to Carbon instance
                $createdAt = \Carbon\Carbon::parse($data->created_at);
            @endphp
            <p class="no">Created at {{ $createdAt->toFormattedDateString() }} ,
                             {{ $createdAt->format('h:i A') }}</p>

            <div class="action-buttons">
                <a class="btn btn-danger" href="{{ url('user_delete_post', $data->id) }}" onclick="confirmation(event)">Delete</a>
                <a class="btn btn-success"href="{{ url('user_edit_post', $data->id) }}" >Edit</a>
            </div>
        </div>
    @endforeach
    @include('home.footer')

    <script>
        function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
                title: "Are you sure to Delete this post?",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["No!", "Yes! Remove it!"],
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });



    }

        // function confirmDelete(url) {
        //     if (confirm('Are you sure you want to delete this post?')) {
        //         window.location.href = url;
        //     }
        // }
    </script>
</body>

</html>
