<?php require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teapot | Cart</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="resources/logo.png">
</head>

<body>

    <?php include "header.php" ?>
    <br>
    <?php
    if (isset($_SESSION['user'])) {

        $uid = $_SESSION['user']['id'];

    ?>

        <section class="h-100" style="background-color: #eee;">
            <div class="container h-100 py-5">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-10">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                            <div>
                                <!-- <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p> -->
                            </div>
                        </div>

                        <?php

                        $cart_rs = Database::search("SELECT 
    cart.product_id,
    cart.user_id,
    cart.qty AS cart_qty, 
    product.id AS product_id,
    product.title,
    product.description,
    product.price,
    product.qty AS product_qty,
	  product.main_img, 
	 product.main_img AS product_img
FROM 
    `cart` 
INNER JOIN 
    `product` 
ON 
    cart.product_id = product.id 
WHERE
    cart.user_id = '$uid';
");
                        $total = null;

                        for ($i = 0; $cart_rs->num_rows > $i; $i++) {

                            $fetch_cart = $cart_rs->fetch_assoc();

                            $total += $total + ($fetch_cart['price'] * $fetch_cart['cart_qty']);

                        ?>


                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">

                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="admin/<?php echo ($fetch_cart['product_img']); ?>" class="img-fluid rounded-3" alt="Cotton T-shirt">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2"><?php echo ($fetch_cart['title']); ?></p>
                                            <p><span class="text-muted">Qty: <?php echo ($fetch_cart['product_qty']); ?></span></p>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <h4><?php echo ($fetch_cart['cart_qty']); ?></4>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h5 class="mb-0"><?php echo ($fetch_cart['price']); ?>.00LKR</h5>
                                        </div>

                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <form action="deleteFromCart.php" method="post">
                                                <input type="text" name="pid" value="<?php echo ($fetch_cart['product_id']); ?>" hidden />
                                                <button type="submit" class="but btn-outline-danger text-danger"><i class="fas fa-trash fa-lg"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }
                        ?>

                        <h1>Total: <?php echo ($total); ?>LKR</h1>

                        <div class="card">
                            <div class="card-body">
                                <form action="checkout.php" method="post">
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    <?php
    } else {
    ?>
        <script>
            window.location = "account.php";
        </script>
    <?php
    }

    ?>

    <br>
    <?php include "footer.php" ?>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>