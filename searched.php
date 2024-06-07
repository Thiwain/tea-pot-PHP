<?php require 'connection.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teapot | Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="resources/logo.png">
</head>

<body>
    <?php include 'header.php' ?>
    <br>

    <?php
    $s = $_GET['s'];
    $srs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $s . "%' OR `description` LIKE '%" . $s . "%'");
    ?>

    <div class="container-fluid">

        <div class="row">
            <div class="d-flex justify-content-center">
                <h1>You Searched `<?php echo ($s); ?>`</h1>
            </div>
        </div>

        <?php
        if ($srs->num_rows != 0) {
        ?>
            <div class="row justify-content-center mt-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 gap-3 justify-content-center align-items-center">


                    <?php




                    for ($i = 0; $i < $srs->num_rows; $i++) {
                        $fetched_p = $srs->fetch_assoc();

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
                                            <img src="<?php echo ($fetched_p['main_img']); ?>" style="height: 100px;" class="img-fluid" alt="Soup Bowl">
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
        <?php
        } else {
        ?>

        <?php
        }
        ?>


    </div>


    <br>
    <?php include 'footer.php' ?>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

</body>



</html>