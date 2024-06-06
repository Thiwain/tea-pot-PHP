<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teapot | Home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="resources/logo.png">
</head>

<body>

    <?php include 'header.php';
    require 'connection.php';

    ?>

    <?php
    $pid = $_GET['id'];

    $p_details = Database::search("SELECT * FROM `product` WHERE `id` = '$pid'");
    $p_data = $p_details->fetch_assoc();

    ?>

    <div class="container mt-5">
        <div class="row">
            <!-- Image Grid -->
            <div class="col-md-6">
                <div class="row">

                    <?php
                    $p_img = Database::search("SELECT * FROM `product_img` WHERE `product_id`='$pid'");

                    for ($i = 0; $i < $p_img->num_rows; $i++) {
                        $p_img_data = $p_img->fetch_assoc();
                    ?>

                        <div class="col-6 mb-3">
                            <img src="<?php echo ($p_img_data['url']); ?>" class="img-fluid" alt="Product Image 1">
                        </div>

                    <?php
                    }
                    ?>



                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="fw-bold"><?php echo ($p_data['title']); ?></h1>
                <h2 class="text-primary"><?php echo ($p_data['price']); ?> LKR</h2>
                <p class="mt-4"><?php echo ($p_data['description']); ?></p>
                <form action="" method="POST">
                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" max="<?php echo ($p_data['qty']); ?>" class="form-control" id="quantity" name="quantity" value="1" min="1">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" onclick="addToCartSp('<?php echo ($p_data['id']); ?>',event);">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>

    <br>

    <?php include 'footer.php' ?>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>