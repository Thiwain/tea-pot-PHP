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
    if (isset($_SESSION['user'])) {
    ?>

        <div class="container">
            <div class="row justify-content-center">
                <!-- Billing Information -->
                <div class="col-md-8">
                    <h3 class="mb-4">Billing Information</h3>
                    <form method="post" action="checkoutProcess.php">
                        <div class="form-group">
                            <label for="rname">Receiver's Name</label>
                            <input type="text" class="form-control" id="rname" name="rname" placeholder="Receiver's Name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                        </div>
                        <!-- <button type="submit" class="btn btn-primary mt-3">Continue</button> -->
                        <a href="cart.php" class="btn btn-link mt-3">Return to Cart</a>
                    </form>
                </div>
                <!-- Order Summary -->
                <div class="col-md-8 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Order Summary</h5>
                            <!-- PHP code for order summary -->
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
                       cart.user_id = '" . $_SESSION['user']['id'] . "';
                   ");
                            $total = null;

                            for ($i = 0; $cart_rs->num_rows > $i; $i++) {

                                $fetch_cart = $cart_rs->fetch_assoc();

                                $total += $total + ($fetch_cart['price'] * $fetch_cart['cart_qty']);
                            }
                            ?>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal</span>
                                <span><?php echo $total; ?> LKR</span>
                            </div>
                            <?php
                            $srs = Database::search("SELECT `id`, `charge` FROM `teapot_db`.`shipping` WHERE  `id`=1");

                            $shipping_c = $srs->fetch_assoc();
                            $charge = $shipping_c['charge'];
                            ?>
                            <div class="d-flex justify-content-between mb-3">
                                <span>Shipping</span>
                                <span><?php echo $charge; ?> LKR</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <span><strong>Total</strong></span>
                                <span><strong><?php echo $total + $charge; ?> LKR</strong></span>
                            </div>
                            <hr>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="tnc" required>
                                <label class="form-check-label" for="tnc">
                                    I agree to the <a href="#">terms and conditions</a>
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="subscribe">
                                <label class="form-check-label" for="subscribe">
                                    Get emails about product updates and events. If you change your mind, you can unsubscribe at any time. <a href="#">Privacy Policy</a>
                                </label>
                            </div>

                            <button class="btn btn-primary w-100" type="submit" onclick="getCheckoutInfo();">Place Order</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>



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
    <?php include 'footer.php' ?>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>



</html>