<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    @include('admin.css')
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
                <form action="{{ url('updated_post', $post->id) }}" method="POST" enctype="multipart/form-data">
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
                        <textarea name="description" id="postDescription" cols="50" rows="4" oninput="wordCount()">{{ $post->description }}</textarea>
                        <div style="text-align: right" id="charCount">
                        </div>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label>Current Image</label>
                        <img src="/postImage/{{ $post->image }}" id="img" alt="No Image" class="image-preview">

                    </div>

                    <div class="post">
                        <label>Change Image</label>
                        <div class="image-preview">
                            <input class="form-control form-control-lg" name="image" type="file" id="imgInp">
                        </div> @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="post">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>

            @include('admin.footer')

            <script>
                //word limit
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
                document.getElementById('imgInp').onchange = evt => {
                    const [file] = imgInp.files;
                    if (file) {
                        img.src = URL.createObjectURL(file);
                    }

                }
            </script>
</body>

</html>
