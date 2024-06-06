<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teapot | Home</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="resources/logo.png">
</head>

<body>

    <?php include 'header.php' ?>

    <?php
    if (isset($_SESSION['user'])) {
    ?>
        <br>

        <div class="container">
            <div class="row flex-lg-nowrap">


                <div class="col">
                    <div class="row">
                        <div class="col mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="e-profile">
                                        <div class="row">
                                            <div class="col-12 col-sm-auto mb-3">
                                                <div class="mx-auto" style="width: 140px;">
                                                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                                        <!-- <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span> -->
                                                        <?php

                                                        if ($_SESSION['user']['gender_id'] == 1) {
                                                            echo '<img src="resources/male.png" width="140" height="140" alt="">';
                                                        } else {
                                                            echo '<img src="resources/female.png" width="140" height="140" alt="">';
                                                        }

                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                                <div class="text-center text-sm-left mb-2 mb-sm-0">
                                                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?php echo $_SESSION['user']['fname'] . ' ' . $_SESSION['user']['lname']; ?></h4>
                                                    <p class="mb-0"><?php echo $_SESSION['user']['email']; ?></p>
                                                </div>
                                                <div class="text-center text-sm-right">
                                                    <span class="badge badge-secondary">Member</span>
                                                    <?php
                                                    $datetimeString = $_SESSION['user']['reg_datetime'];
                                                    $timestamp = strtotime($datetimeString);
                                                    $readableFormat = date("F j, Y, g:i a", $timestamp);
                                                    ?>
                                                    <div class="text-muted"><small>Joined <?php echo $readableFormat; ?></small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
                                        </ul>
                                        <div class="tab-content pt-3">
                                            <div class="tab-pane active">
                                                <form class="form" novalidate="">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>First Name</label>
                                                                        <input class="form-control" type="text" name="name" placeholder="John Smith" value="<?php echo $_SESSION['user']['fname']; ?>" id="fname" />
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Last Name</label>
                                                                        <input class="form-control" type="text" name="username" placeholder="johnny.s" value="<?php echo $_SESSION['user']['lname']; ?>" id="lname" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input class="form-control" type="text" placeholder="user@example.com" value="<?php echo $_SESSION['user']['email']; ?>" id="email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label>Gender</label>
                                                                        <?php

                                                                        $gender_rs = Database::search("SELECT * FROM `gender` WHERE `g_id` = ' " . $_SESSION['user']['gender_id'] . "'");
                                                                        $gender_row = $gender_rs->fetch_assoc();

                                                                        ?>
                                                                        <input class="form-control" type="text" placeholder="user@example.com" disabled value="<?php echo $gender_row['g_name']; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="row">
                                                                <div class="col mb-3">
                                                                    <div class="form-group">
                                                                        <label>About</label>
                                                                        <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-6 mb-3">
                                                            <div class="mb-2"><b>Change Password</b></div>
                                                            <div class="row">
                                                                <div class="col d-flex justify-content-start">

                                                                    <a class="btn btn-primary" href="reset-password.php?email=<?php echo $_SESSION['user']['email']; ?>" id="triggerModalBtn" type="button">Reset Password</a>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                            <button class="btn btn-primary" type="submit" onclick="saveProfile();">Save Changes</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 col-md-3 mb-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="px-xl-3">
                                        <button class="btn btn-block btn-secondary">
                                            <a href="logout.php" class="text-decoration-none text-white">
                                                <i class="fa fa-sign-out"></i>
                                                <span>Logout</span>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title font-weight-bold fw-bold">Security Policy</h6>
                                    <ul>
                                        <li><strong>Keep Your Password Secure:</strong> Never share your password with anyone. Choose a strong, unique password and update it regularly.</li>
                                        <li><strong>Beware of Phishing Attempts:</strong> Be cautious of suspicious emails, messages, or links asking for your personal information.</li>
                                        <li><strong>Monitor Your Account Activity:</strong> Regularly review your account activity and report any unauthorized access or suspicious behavior.</li>
                                        <li><strong>Secure Your Devices:</strong> Protect your devices with strong passwords or biometric authentication and enable device encryption.</li>
                                        <li><strong>Limit Access:</strong> Only grant access to your account to trusted individuals or services.</li>
                                        <li><strong>Report Security Issues:</strong> Promptly report any security vulnerabilities or concerns to the appropriate channels.</li>
                                        <li><strong>Log Out When Not in Use:</strong> Always log out of your account when you're finished using it, especially on shared or public devices.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close btn btn-outline-dark" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal body content -->
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>




        <br>

        <?php include 'footer.php' ?>

    <?php
    } else {
    ?>
        <script>
            window.location = "account.php";
        </script>
    <?php
    }
    ?>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript code to trigger the modal
        document.getElementById('triggerModalBtn').addEventListener('click', function() {
            $('#exampleModalCenter').modal('show');
        });
    </script>
    <script src="js/script.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>