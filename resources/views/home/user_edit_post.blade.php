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
            margin: 0 auto;
            max-width: 100%;
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
            color: #333;
            margin-bottom: 20px;
        }

        .postTitle {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            padding: 30px;
            color: #333;
        }

        .post label {
            display: block;
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #333;
        }

        .post input[type="text"],
        .post textarea,
        .post input[type="file"],
        .post input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: none;
        }

        .post textarea {
            height: 400px;
        }

        .post input[type="submit"] {
            background-color: #2b2278;
            color: white;
            cursor: pointer;
        }

        .post input[type="submit"]:hover {
            background-color: #141414;
        }
    </style>
</head>

<body>
    @include('home.test')
    <h1 class="postTitle">EDIT POST</h1>
    <div class="blog_content">
        <form action="{{ url('user_updated_post', $post->id) }}" method="POST" enctype="multipart/form-data"
            class="post">
            @csrf
            <label>Post Title</label>
            <input type="text" name="title" value="{{ $post->title }}">
            @error('title')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <label>Post Description</label>
            <textarea name="description" id="" cols="50"
                rows="4">{{ $post->description }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <div>
                <label>Current Image</label>
                <img src="/postImage/{{ $post->image }}" alt="No Image" style="max-width: 300px;">
            </div>

            <label>Change Image</label>
            <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" />
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </div>

    @include('home.footer')

</body>

</html>
