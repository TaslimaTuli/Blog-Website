<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @include('admin.css')
</head>

<body>
    @include('sweetalert::alert')
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')

        <div class="page-content">
            {{-- @if (session()->has('message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x</button>
                    {{ session()->get('message') }}
                </div>
            @elseif (session()->has('message_edit'))
                 <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x</button>
                    {{ session()->get('message_edit') }}
                </div>
            @endif --}}
            <h1 class="postTitle">ALL PENDING POSTS</h1>
            <table>
                <tr>
                    <th>Post Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Posted by</th>
                    <th>Created at</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @if (count($data) == 0)
                    <td colspan="7">No Pending Post Found</td>
                @else
                    @foreach ($data as $post)
                    <tr>
                        <td class="no">{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td><img src="postImage/{{ $post->image }}" alt="No Image"></td>
                        <td>{{ $post->name }}</td>
                        <td class="no">{{ $post->created_at }}</td>
                        <td>{{ $post->status }}</td>
                        <td class="no">
                            <a href="{{ url('accept_post', $post->id) }}" class="btn btn-outline-secondary">
                                Accept</a>
                            <a href="{{ url('decline_post', $post->id) }}" class="btn btn-primary" onclick="confirmation(event)">
                                Reject</a>
                        </td>
                        {{-- <td>
                            <a href="{{ url('delete_post', $post->id) }}" class="btn btn-danger"
                                onclick="confirmation(event)">
                                Delete</a>
                        </td>
                        <td>
                            <a href="{{ url('edit_post', $post->id) }}" class="btn btn-success">
                                Edit</a>
                        </td> --}}
                    </tr>
                @endforeach
                @endif

            </table>


        </div>

        @include('admin.footer')
    </div>
</body>

<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');
        console.log(urlToRedirect);
        swal({
                title: "Are you sure to Reject this post?",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                buttons: ["No!", "Yes! Reject it!"],
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });



    }
</script>

</html>
