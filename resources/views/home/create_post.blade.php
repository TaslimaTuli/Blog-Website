<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.homeCss')
    <style>
        body {
            /* font-family: 'Arial', sans-serif; */
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header_section {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .postTitle {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            padding: 30px;
            color: #333;
        }

        .page-content {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* height: 820px; */
        }

        form {
            width: 100%;
            margin: 20px 0;
        }

        form div {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-size: 18px;
            margin-bottom: 5px;
            color: #333;
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
            resize: none;
        }
        .post textarea {
            height: 400px;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #2b2278;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #141414;
        }

        .text-danger {
            color: #dc3545;
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
    </style>
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
                <label>Image</label>
                <div class="image-preview" id="imagePreview"></div>
                <input class="form-control form-control-lg" id="formFileLg" type="file" name="image" />
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
