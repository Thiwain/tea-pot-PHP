<?php
$uploadDir = 'uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
$filePaths = [];

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['images']) && count($_FILES['images']['name']) <= 4) {
    foreach ($_FILES['images']['name'] as $key => $val) {
        $fileType = $_FILES['images']['type'][$key];

        if (in_array($fileType, $allowedTypes)) {
            $fileTmpPath = $_FILES['images']['tmp_name'][$key];
            $newFileName = uniqid() . '.jpg';
            $destPath = $uploadDir . $newFileName;

            // Convert and save the image as .jpg
            switch ($fileType) {
                case 'image/png':
                    $image = imagecreatefrompng($fileTmpPath);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($fileTmpPath);
                    break;
                case 'image/webp':
                    $image = imagecreatefromwebp($fileTmpPath);
                    break;
                default:
                    $image = imagecreatefromjpeg($fileTmpPath);
                    break;
            }

            if ($image !== false) {
                imagejpeg($image, $destPath, 90);
                imagedestroy($image);
                $filePaths[] = $destPath;
            }
        } else {
            echo 'Invalid file type: ' . $val;
            exit;
        }
    }

    if (count($filePaths) > 0) {
        echo 'Uploaded file paths:<br>';
        foreach ($filePaths as $path) {
            echo $path . '<br>';
        }
    }
} else {
    echo 'Please upload up to 4 images.';
}
