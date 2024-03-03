<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    @include('sweetalert::alert')
    <div class="t">
        @include('admin.header')
    </div>

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')

        <div class="page-content">
            {{-- @if (session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        x</button>
                    {{ session()->get('message') }}
                </div>
            @endif --}}

            <h1 class="postTitle">ADD POST</h1>
            <div>
                <form action="{{ url('add_post') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="post">
                        <label>Post Title</label>
                        <input type="text" name="title" value="{{ old('title') }}">
                        <div></div>
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
                        <label>Image</label>
                        <div class="image-preview">
                            <input class="form-control form-control-lg" name="image" type="file" id="imgInp">
                            <img id="img" class="image-preview" />
                        </div>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="post">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>

            @include('admin.footer')
        </div>
    </div>

    <script>
        // word limit
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
