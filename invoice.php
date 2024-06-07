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

    <?php include 'header.php';

    $in_id = $_GET['id'];

    if (isset($_SESSION['user'])) {


        $rs = Database::search("SELECT * FROM `invoice` WHERE `id`='$in_id'");

        $ft_rs = $rs->fetch_assoc();


    ?>

        <div class="container m-5 mb-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-15">Invoice #<?php echo $in_id ?> <span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                <div class="mb-4">
                                    <h2 class="mb-1 text-muted">Teapot.com</h2>
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">3184 Spruce Drive Pittsburgh, PA 15201</p>
                                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i> teapot@gmail.com</p>
                                    <p><i class="uil uil-phone me-1"></i> 012-345-6789</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">
                                        <h5 class="font-size-16 mb-3">Billed To:</h5>
                                        <h5 class="font-size-15 mb-2"><?php echo ($ft_rs['reciver_name']); ?></h5>
                                        <p class="mb-1"><?php echo ($ft_rs['address']); ?></p>
                                        <p class="mb-1"><?php echo ($_SESSION['user']['email']) ?></p>
                                        <p><?php echo ($ft_rs['phone']); ?></p>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">
                                        <div>
                                            <h5 class="font-size-15 mb-1">Invoice No:</h5>
                                            <p>#DZ0112</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1">Invoice Date:</h5>
                                            <p>12 Oct, 2020</p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1">Order No:</h5>
                                            <p>#<?php echo $in_id ?> </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="py-2">
                                <h5 class="font-size-15">Order Summary</h5>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>

                                            <?php

                                            $item_rs = Database::search("SELECT * FROM `invoice_item` INNER JOIN `product` ON `invoice_item`.`product_id`=`product`.`id` WHERE `invoice_id`='$in_id'");

                                            $item_rs2 = Database::search("SELECT invoice_item.qty AS invoice_qty, product.qty AS product_qty 
                 FROM `invoice_item` 
                 INNER JOIN `product` 
                 ON `invoice_item`.`product_id` = `product`.`id` 
                 WHERE `invoice_id` = '$in_id'");

                                            $total = null;

                                            for ($i = 0; $i < $item_rs->num_rows; $i++) {

                                                $firs = $item_rs->fetch_assoc();
                                                $firs2 = $item_rs2->fetch_assoc();


                                                $total += $firs['price'] * $firs2['invoice_qty'];


                                            ?>

                                                <tr>
                                                    <th scope="row"><?php echo $i ?></th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 mb-1"><?php echo $firs['title'] ?></h5>
                                                        </div>
                                                    </td>
                                                    <td><?php echo $firs['price'] ?></td>
                                                    <td><?php echo $firs2['invoice_qty'] ?></td>
                                                    <td class="text-end"><?php echo $firs['price'] * $firs2['invoice_qty'] ?>LKR</td>
                                                </tr>

                                            <?php
                                                # code...
                                            }
                                            ?>
                                            <!-- end tr -->

                                            <!-- end tr -->


                                            <tr>
                                                <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                <td class="text-end"><?php echo $firs['price'] + $firs2['invoice_qty'] ?>LKR</td>
                                            </tr>
                                            <!-- end tr -->

                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Shipping Charge :</th>
                                                <td class="border-0 text-end">300LKR</td>
                                            </tr>
                                            <!-- end tr -->

                                            <!-- end tr -->
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0 fw-semibold"><?php echo $total+300 ?>LKR</h4>
                                                </td>
                                            </tr>
                                            <!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->
                                <div class="d-print-none mt-4">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                                        <a href="#" class="btn btn-primary w-md">Send</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
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
    <?php include 'footer.php' ?>

    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>