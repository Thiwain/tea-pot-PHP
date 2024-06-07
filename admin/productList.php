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

        <?php include 'sidebar.php'; ?>

        <?php
        if (isset($_SESSION['au'])) {
        ?>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <h1 class="mt-3 mb-3 fw-bold">Orders</h1>
                </div>
                <div class="row justify-content-center">

                    <div class="col-md-10">
                        <!-- DataTables Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>#</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>#</th>
                                                <th>#</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $p_search = Database::search("SELECT * FROM `product`");

                                            for ($i = 0; $i < $p_search->num_rows; $i++) {
                                                $fp = $p_search->fetch_assoc();
                                            ?>
                                                <tr>

                                                    <form action="updateProductProcess.php" method="post">
                                                        <td><?php echo $fp['id'] ?><input hidden type="text" name="ids" class="form-control" value="<?php echo $fp['id'] ?>" /></td>
                                                        <td><input type="text" class="form-control" value="<?php echo $fp['title'] ?>" name="title" /></td>
                                                        <td>
                                                            <textarea name="description" class="form-control col-12" id="" cols="50" rows="3"><?php echo $fp['description'] ?></textarea>
                                                        </td>
                                                        <td><input type="number" class="form-control " value="<?php echo $fp['price'] ?>" name="price" /></td>
                                                        <td><input type="number" class="form-control " value="<?php echo $fp['qty'] ?>" name="qty" /></td>
                                                        <td><button class="btn btn-success" type="submit">Save</button></td>
                                                    </form>
                                                    <td>
                                                        <!-- <form action="deleteAproduct.php" method="post">
                                                            <input type="text" class="form-control" name="id" value="<?php echo $fp['id'] ?>" />
                                                            <button class="btn btn-danger" type="submit">Delete</button>
                                                        </form> -->
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>

                                            <!-- <tr>
                                                <td>Cedric Kelly</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2012/03/29</td>
                                                <td>$433,060</td>
                                                <td>$433,060</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>