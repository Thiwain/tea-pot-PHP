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

    <br>

    <div class="container-fluid">

        <!-- Carousel -->

        <div id="carouselExampleIndicators" class="carousel slide d-none d-sm-none d-md-flex">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="height: 500px;">
                <div class="carousel-item active">
                    <img src="resources/carousel/0090000127-scaled.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="resources/carousel/afternoon-tea-for-two-royalty-free-image-1601933308.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="resources/carousel/Cover_IMG_0593.webp" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Carousel -->

        <div class="row d-flex d-lg-none">
            <div class="d-flex justify-content-center">
                <img src="resources\carousel\0090000127-scaled.jpg" class="col-12" alt="" srcset="">
            </div>
        </div>

        <!-- Heading -->
        <br>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <h3 class="fw-bold"><i class="fa-solid fa-mug-hot"></i> Our Collection</h3>
            </div>
        </div>
        <br>
        <!-- Heading -->

        <div class="row justify-content-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 gap-3 justify-content-center align-items-center">


                <?php

                $product_results = Database::search("SELECT * FROM `product`");


                for ($i = 0; $i < $product_results->num_rows; $i++) {
                    $fetched_p = $product_results->fetch_assoc();

                ?>


                    <div class="col" style="cursor: pointer;">
                        <div class="card p-3" style="box-shadow: 0px 0px 5px 5px #d1d1d1;">
                            <a href="spview.php?id=<?php echo $fetched_p['id']; ?>" class="text-decoration-none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mt-2">
                                        <h5 class="text-uppercase text-black"><?php echo ($fetched_p['title']); ?></h5>
                                        <div class="mt-2">
                                            <h6 class="text-uppercase mb-0"><?php echo ($fetched_p['price']); ?>LKR</h6>
                                        </div>
                                    </div>
                                    <div class="image">
                                        <img src="admin/<?php echo ($fetched_p['main_img']); ?>" style="height: 100px;" class="img-fluid" alt="Soup Bowl">
                                    </div>
                                </div>
                            </a>
                            <button class="btn btn-outline-dark mt-2" onclick="addToCartCard('<?php echo $fetched_p['id']; ?>',event);">Add to cart</button>
                        </div>
                    </div>

                <?php
                }
                ?>


                <!-- Repeat the above single item divs for other items -->
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