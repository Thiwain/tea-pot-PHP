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

function uploadImagesAndCreateP() {
    const files = document.getElementById('imageInput').files;
    if (files.length > 4) {
        alert("You can only upload a maximum of 4 images");
        return;
    }

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value);
    formData.append('price', document.getElementById('price').value);
    formData.append('qty', document.getElementById('qty').value);


    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'uploadPoductProcess.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            document.getElementById('uploadStatus').innerHTML = xhr.responseText;
        } else {
            document.getElementById('uploadStatus').innerHTML = 'An error occurred while uploading images.';
        }
    };
    xhr.send(formData);
}