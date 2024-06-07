<?php

session_start();
require 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    // Check if any of the fields are empty
    if (empty($title) || empty($description) || empty($price) || empty($qty)) {
        echo "One or more fields are empty. Please fill in all fields.";
    } else {
        // Directory to upload images
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

            function generateRandom9DigitInt()
            {
                return mt_rand(100000000, 999999999);
            }

            // Example usage
            $randomNumber = generateRandom9DigitInt();

            if (count($filePaths) > 0) {
                // Insert product into the database and get the product ID
                $mainImg = $filePaths[0];
                Database::iud("INSERT INTO `teapot_db`.`product` (`id`,`title`, `description`, `price`, `qty`, `main_img`) VALUES ('$randomNumber', '" . $title . "', '" . $description . "', '$price', '$qty', '$mainImg')");

                // Insert images into the product_img table
                foreach ($filePaths as $path) {
                    Database::iud("INSERT INTO `teapot_db`.`product_img` (`product_id`, `url`) VALUES ('$randomNumber', '$path')");
                }

                echo 'Product and images have been uploaded successfully.';
            }
        } else {
            echo 'Please upload up to 4 images.';
        }
    }
}
