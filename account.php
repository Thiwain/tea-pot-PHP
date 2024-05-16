<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teapot | Sign Up & Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="resources/logo.png">
</head>

<body>

    <?php include "header.php"; ?>

    <br>

    <section class="ftco-section bg-light">
        <div class="container">

            <?php

            $email = "";
            $password = "";

            if (isset($_COOKIE["email"])) {
                $email = $_COOKIE["email"];
            }

            if (isset($_COOKIE["password"])) {
                $password = $_COOKIE["password"];
            }

            ?>

            <div class="row justify-content-center" id="signUpBox">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <img src="resources/Cover_IMG_0593.webp" height="550" class="d-none d-sm-none d-md-block col-md-5">
                        <div class="login-wrap p-4 p-md-5 col-md-7">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="mb-4">Sign Up</h3>
                                <p id="signUpWarn" class="text-danger"></p>
                            </div>
                            <p class="signInWrn" id="signUpWrn"></p>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="label" for="fname">First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" required name="fname" id="fname" />
                                </div>
                                <div class="col-md-6">
                                    <label class="label" for="lname">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" required name="lname" id="lname" />
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="gender">Gender</label>
                                <select name="gender" class="form-control" id="gender">
                                    <option value="">--Select Gender--</option>
                                    <?php
                                    require "connection.php";
                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;
                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $d["g_id"]; ?>"><?php echo $d["g_name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="semail">Email</label>
                                <input type="text" class="form-control" placeholder="Email" required name="email" id="semail" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="spw">Password</label>
                                <input type="password" class="form-control" placeholder="Password" required name="password" id="spw" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="rspw">Re-Type Password</label>
                                <input type="password" class="form-control" placeholder="Password" required name="repassword" id="rspw" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded px-3" onclick="signUp();">Sign Up</button>
                            </div>
                            <p class="text-center">Already have an account? <a href="#signInBox" data-toggle="tab" onclick="filpAuth();">Log In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Log In Section -->
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center d-none" id="signInBox">
                <div class="col-md-12 col-lg-8">
                    <div class="wrap d-md-flex">
                        <img src="resources/Cover_IMG_0593.webp" height="550" class="d-none d-sm-none d-md-block col-md-5">
                        <div class="login-wrap p-4 p-md-5 col-md-7">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="mb-4">Log In</h3>
                            </div>
                            <p id="signInWarn" class="text-danger"></p>
                            <div class="form-group mb-3">
                                <label class="label" for="email">Email</label>
                                <input type="text" class="form-control" placeholder="Email" required name="email" id="email" />
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Password</label>
                                <input id="password" type="password" class="form-control" placeholder="Password" required name="password" />
                            </div>
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="rememberme" name="rememberme">
                                <label class="form-check-label" for="rememberme">Remember Me</label>
                            </div>
                            <div class="form-group">
                                <button type="button" class="form-control btn btn-primary rounded submit px-3" onclick="logIn();">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex align-items-center justify-content-between">
                                <a href="#exampleModal" id="forgotPasswordLink" data-toggle="modal">Forgot Password</a>
                            </div>
                            <p class="text-center">Not a member? <a href="#signUpBox" data-toggle="tab" onclick="filpAuth();">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End of Log In Section -->

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="forgotPwModal">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="label" for="email">Type your email to get verification code</label>
                            <p class="text-danger" id="fpwMoadlWrn"></p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row flex-row align-items-center">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" placeholder="Email" required name="email" id="fpwEmail"/>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary w-100" onclick="sendEmail();">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="Verification Code" required name="code" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="fpwContinue">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Forgot Password Modal -->


    <br>
    <?php include "footer.php" ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>