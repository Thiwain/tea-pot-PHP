<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="resources/logo.png">
    <title><?php echo $_GET['email']; ?> | Reset Password</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center text-center mb-5">
            <div class="col-12">
                <div class="row justify-content-center align-items-center bg-black">
                    <img src="resources/logo.png" class="mt-3 mb-2 logo-resetpw" alt="">
                    <h2 class="text-light fw-bolder mb-3">Tea Pot</h2>
                </div>
                <div class="row justify-content-center align-items-center mt-5">
                    <h3 class="text-dark fw-bold mt-3">Reset Password</h3>
                </div>
            </div>
            <div class="col-10 col-md-5 col-lg-3 gap-3">
                <p class="" id="nPwWarn"></p>
                <input type="password" class="form-control mt-3" placeholder="New Password" name="np" id="pw"/>
                <input type="password" class="form-control mt-3" placeholder="Confirm Password" name="cp" id="cpw"/>
                <button id="resetPwBtnS" onclick="resetPw('<?php echo $_GET['email']; ?>');" class="btn btn-primary mt-3">Change Password</button>

            </div>

        </div>

    </div>
    <?php include 'footer.php' ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>