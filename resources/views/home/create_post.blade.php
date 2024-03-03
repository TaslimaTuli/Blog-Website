<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homeCss')
</head>

<body>
    @include('sweetalert::alert')
    @include('home.test')

    <h1 class="postTitle">CREATE POST</h1>
    <div class="page-content">
        <form action="{{ url('user_post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="post">
                <label>Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="post">
                <label>Post Description</label>
                <textarea name="description" id="postDescription" cols="50" rows="4" oninput="wordCount()">
                {{ old('description') }}
                </textarea>
                <div style="text-align: right" id="charCount">Characters Limit: 1000</div>

                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="post">
                <label>Image (Max Size: 2MB)</label>
                <div class="image-preview">
                    <input class="form-control form-control-lg" name="image" type="file" id="imgInp">
                    <img id="img" class="image-preview" />
                 </div>
                {{-- <div class="image-preview" id="imagePreview"></div>
                <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" /> --}}
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="post">
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </form>
    </div>
    @include('home.footer')


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
