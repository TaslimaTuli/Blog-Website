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
            <textarea name="description" id="postDescription" oninput="wordCount()">{{ $post->description }}
            </textarea>
            <div style="text-align: right" id="charCount">
            </div>

            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div>
                <label>Current Image</label>
                <img src="/postImage/{{ $post->image }}" alt="No Image" id="img">
            </div>

            <label>Change Image</label>
            <div class="image-preview">
                <input name="image" type="file" id="imgInp">
            </div>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Update" class="btn btn-primary">
        </form>
    </div>

    @include('home.footer')

    <script>
        //word limit

        /* The function calculates the remaining character count in a textarea
        with the id 'postDescription' and updates the text content of an element
        with the id 'charCount' to display either the remaining characters or a
        message indicating that the character limit has been reached.*/

        function wordCount() {
            let textarea = document.getElementById('postDescription');
            let charCountElement = document.getElementById('charCount');
            let remainingChars = 1000 - textarea.value.length;

            if (remainingChars <= 0) {
                charCountElement.style.color = 'red';
                charCountElement.textContent = 'Character limit reached!';
            } else {
                charCountElement.style.color = ''; // Reset color
                charCountElement.textContent = 'Characters remaining: ' + remainingChars;
            }

        }


        //image preview

        /* listens for changes in the selected file of an input element with the id
        'imgInp' and sets the 'src' attribute of an image element to the URL of the
        selected file, allowing it to be displayed on the webpage dynamically.*/

        document.getElementById('imgInp').onchange = evt => {
            const [file] = imgInp.files;
            if (file) {
                img.src = URL.createObjectURL(file);
            }

        }
    </script>

</body>

</html>
