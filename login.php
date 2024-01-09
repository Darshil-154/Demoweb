<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<style>
    body {

        background-image: url("bg.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .err {
        color: red;
    }
</style>

<body>
<div class="err">
    <?php
    function data($info)
    {

        $info = htmlspecialchars($info);

        return $info;
    }
    include 'db_connect.php';
    if (array_key_exists('Login', $_POST)) {
        $pass = $input = $password = "";
        $passwordwar = "";
        // error_reporting(0);
        $err = "Enter valid E-mail or Password";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $input = data($_POST["user-email"]);
            $password = data($_POST["password"]);
            $pass = MD5($password);
        }
        $sql = "SELECT * FROM info
        WHERE (username = '$input' OR email = '$input')
          AND password = '$pass'
          limit 1";
         echo "sql is: " . $sql;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {


            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['name'] = $row["name"];
                $_SESSION['username'] = $row["username"];
                $_SESSION['email'] = $row["email"];
                echo "<script>alert('welcome, " . $row['name'] ."')</script>";
            }

            echo '<script> window.location.href = "home.php";</script>';
        } else {
            echo "Enter valid login info";
        }
        mysqli_close($conn);
    }
    ?>
</div>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


                            <div class="card mb-3 shadow-7-strong" style="background: rgba(0,0,0,0.1); backdrop-filter: blur(70px);">

                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form method="post" class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>


                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username or E-mail</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="user-email" class="form-control" id="user-email" required>
                                                <div class="invalid-feedback">Please enter valid username or email.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control  class=" form-control <?php echo (!empty($passwordwar)) ? 'invalid-password' : ''; ?>" id="pass" name="pass" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input class="btn btn-primary w-100" type="submit" name="Login" value="Login">
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="sign.php">Create an account</a></p>
                                        </div>



                                        <div class="err">


                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Include Bootstrap JavaScript -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>