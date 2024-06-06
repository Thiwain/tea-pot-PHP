<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <style>
        .preview img {
            width: 100px;
            height: 100px;
            margin: 5px;
        }
    </style>
</head>
<body>
    <h1>Upload Images</h1>
    <form id="imageUploadForm">
        <input type="file" id="imageInput" name="images[]" multiple accept="image/*" onchange="previewImages()" />
        <button type="button" onclick="uploadImages()">Upload</button>
    </form>
    <div class="preview" id="preview"></div>
    <div id="uploadStatus"></div>

    <script>
        function previewImages() {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            const files = document.getElementById('imageInput').files;
            if (files.length > 4) {
                alert("You can only upload a maximum of 4 images");
                return;
            }
            for (let i = 0; i < files.length; i++) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(files[i]);
                preview.appendChild(img);
            }
        }

        function uploadImages() {
            const files = document.getElementById('imageInput').files;
            if (files.length > 4) {
                alert("You can only upload a maximum of 4 images");
                return;
            }

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('uploadStatus').innerHTML = xhr.responseText;
                } else {
                    document.getElementById('uploadStatus').innerHTML = 'An error occurred while uploading images.';
                }
            };
            xhr.send(formData);
        }
    </script>
</body>
</html>
