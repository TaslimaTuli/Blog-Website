<!DOCTYPE html>
<html>

<head>
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
            resize: none;
        }
        .post textarea {
            height: 400px;
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

        .t {
            white-space: nowrap;
        }

        .image-preview {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
            max-height: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }


        /* form input[type="submit"]:hover {
            background-color: #45a049;
        } */
    </style>
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

                    {{-- <div class="post">
                        <label>Post Description</label>
                        <textarea name="description" id="" cols="50" rows="4"></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
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
                        <div class="image-preview" id="imagePreview"></div>
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" />
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
        function wordCount() {
            let textarea = document.getElementById('postDescription');
            let charCountElement = document.getElementById('charCount');
            let remainingChars = 1000 - textarea.value.length; // Change 500 to your desired character limit

            if (remainingChars <= 0) {
                charCountElement.style.color = 'red';
                charCountElement.textContent = 'Character limit reached!';
            } else {
                charCountElement.style.color = ''; // Reset color
                charCountElement.textContent = 'Characters remaining: ' + remainingChars;
            }
        }

        //image preview
        document.getElementById('formFileLg').addEventListener('change', function(e) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Clear previous preview

            var file = e.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.setAttribute('src', e.target.result);
                    img.setAttribute('class', 'image-preview');
                    imagePreview.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>


</html>
