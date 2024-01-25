<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    @include('admin.css')
    <style>
        .postTitle {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            padding: 30px;
            color: gainsboro;
        }

        .page-content {
            /* padding: 30px;
            min-height: 100vh; */
            background: #2d3035;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        form div {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form textarea,
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background: gainsboro;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            /* background-color: #4CAF50; */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

       img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .t {
            white-space: nowrap;
        }

    </style>
</head>

<body>
    <div class="t">
        @include('admin.header')
    </div>

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')

        <div class="page-content">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x</button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <h1 class="postTitle">EDIT POST</h1>
            <div>
                <form action="{{ url('updated_post',$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="post">
                        <label>Post Title</label>
                        <input type="text" name="title" value="{{ $post->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="post">
                        <label>Post Description</label>
                        <textarea name="description" id="" cols="50" rows="4" >{{ $post->description }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label>Image</label>
                        <img src="/postImage/{{ $post->image }}" alt="No Image">

                    </div>

                    <div class="post">
                        <label>Change Image</label>
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" />
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="post">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>

            @include('admin.footer')
</body>

</html>
