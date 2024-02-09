<?php 
session_set_cookie_params(0, "/harrs");
session_name("harrs");
session_start();

if (isset($_SESSION['username'])) {
    header('location:admin/dashboard.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="H.A. Room Rental System (HARRS) is a system for room rental management">
    <meta name="author" content="Vicento14">

    <title>HARRS - Login</title>

    <!-- Custom fonts for this template-->
    <link rel="preload" href="css/font.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Custom styles for this template-->
    <link rel="preload" href="css/sb-admin-2.min.css" as="style" onload="this.rel='stylesheet'">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <noscript>
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </noscript>

    <link rel="icon" type="image/x-icon" href="img/HA_RRS_Logo.ico">

</head>

<body class="bg-gradient-secondary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="img/373000.webp" alt="bg-login-page" height="580" width="450">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>HARRS</b> - HA Room Rental System</h1>
                                    </div>
                                    <form class="user" id="sign-in">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="username" aria-describedby="usernameHelp"
                                                placeholder="Enter Username" autocomplete="username" maxlength="255" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" autocomplete="current-password" maxlength="255" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Sign-in
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script defer src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script defer src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- SweetAlert --->
    <script defer src="vendor/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script defer src="js/sb-admin-2.min.js"></script>

    <!-- HARRS Script -->
    <script defer src="js/sign-in.js"></script>

</body>

</html>
<?php } ?>