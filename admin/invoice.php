<?php
session_start();
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="aresources/logo.png" />

    <title> Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.php';
        if (isset($_SESSION['au'])) {


            $in_id = $_GET['id'];



            $rs = Database::search("SELECT 
    invoice.*, 
    invoice_item.qty AS item_qty, 
    user.*
FROM invoice 
INNER JOIN invoice_item ON invoice.id = invoice_item.invoice_id 
INNER JOIN user ON user.id = invoice.user_id 
WHERE invoice.id = '$in_id';
");

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
                                            <p class="mb-1"><?php echo ($ft_rs['email']); ?></p>
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
                                                $isq = Database::search("SELECT invoice_item.qty AS invoice_qty, product.qty AS product_qty, invoice_item.*, product.*
FROM invoice_item 
INNER JOIN product 
ON invoice_item.product_id = product.id 
WHERE invoice_id ='$in_id';
");

                                                $total = 0;

                                                for ($i = 0; $i < $isq->num_rows; $i++) {

                                                    $isq_rs = $isq->fetch_assoc();
                                                    # code...
                                                ?>

                                                    <tr>
                                                        <th scope="row"><?php echo $i; ?></th>
                                                        <td>
                                                            <div>
                                                                <h5 class="text-truncate font-size-14 mb-1"><?php echo $isq_rs['title'] ?></h5>
                                                            </div>
                                                        </td>
                                                        <td><?php echo $isq_rs['price'] ?></td>
                                                        <td><?php echo $isq_rs['invoice_qty'] ?></td>
                                                        <td class="text-end"><?php echo $total += $isq_rs['invoice_qty'] * $isq_rs['price'] ?></td>
                                                    </tr>

                                                <?php
                                                }

                                                ?>



                                                <!-- end tr -->

                                                <!-- end tr -->


                                                <tr>
                                                    <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                    <td class="text-end"><?php echo $total ?>LKR</td>
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
                                                        <h4 class="m-0 fw-semibold"><?php echo $total + 300 ?> LKR</h4>
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
                window.location = "index.php";
            </script>
        <?php
        }
        ?>

        <script src="js/script.js"></script>
        <script src="js/ajax.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>