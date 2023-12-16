<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
  .invalid-password {
    border: 1px solid red;
  }

  body {
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url("bg.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }



  .section {
    display: inline-block;
  }
</style>

<body>
  <?php
  // Initialize variables
  $fname = $lname = $email = $pass = $dob = $web = "";
  $namewar = $emailwar = $passwordwar = $dobwar = $webwar = "";

  // Function to sanitize user input
  function sanitize($info)
  {
    $info = trim($info);
    $info = htmlspecialchars($info);
    $info = stripslashes($info);
    return $info;
  }

  // Form validation and data handling
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["myfname"])) {
      $namewar = "Enter your name";
    } else {
      $namewar1 = sanitize($_POST["myfname"]);
      if (!preg_match("/^[a-zA-Z-' _]*$/", $namewar1)) {
        $namewar = "Enter a valid name";
      }
      $fname = sanitize($_POST["myfname"]);
    }
    if (empty($_POST["mylname"])) {
      $lname = "";
    } else {
      $lname = sanitize($_POST["mylname"]);
    }
    if (empty($_POST["myemail"])) {
      $emailwar = "Enter your email";
    } else {
      $email = sanitize($_POST["myemail"]);
    }
    if (empty($_POST["mydob"])) {
      $dobwar = "Enter your date of birth";
    } else {
      $dob = sanitize($_POST["mydob"]);
    }
    if (empty($_POST["pass"])) {
      $passwordwar = "Please set your password";
    } else {
      $password = sanitize($_POST["pass"]);
      $passwordLength = strlen($password);

      if ($passwordLength >= 6 && $passwordLength <= 10) {
        $pass = $password;
      } else {
        $passwordwar = "Password must be 6 to 10 characters long";
      }
    }


    require_once 'db_connect.php';

    if (!empty($fname) && !empty($email) && !empty($pass)) {
      $check = "SELECT * FROM info WHERE email = '$email'";
      $result = mysqli_query($conn, $check);
      if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('E-mail already exists')</script>";
        echo '<script>window.location.href = "login.php";</script>';
      } else {

        $sql = "INSERT INTO info (firstname, lastname, email, password, DOB) VALUES ('$fname', '$lname', '$email', md5('$pass'), '$dob')";

        if (mysqli_query($conn, $sql)) {
          echo "<script>alert('Sign-up successful')</script>";
          echo '<script>window.location.href = "login.php";</script>';
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
    } 

    mysqli_close($conn); // Close the database connection
  }
  ?>

  <main>

    <div class="container justify-content-center " style="width: 55%;">
      <div class="row">
        <div class="col-lg-8 m-auto d-flex flex-column align-items-center justify-content-center">
          <div class="card shadow-5-strong" style="background: rgba(33,33,33,0); backdrop-filter: blur(60px);">
            <div class="card-body mx-2">
              <div class="pt-2 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
              </div>

              <form class="row g-3 needs-validation" novalidate>
                <div class="col-12">
                  <label for="yourName" class="form-label"><strong>Your Name</strong></label>
                  <input type="text" name="name" class="form-control" id="yourName" required>
                  <div class="invalid-feedback">Please, enter your name!</div>
                </div>

                <div class="col-12">
                  <label for="yourEmail" class="form-label"><strong>Your E-mail</strong> </label>
                  <input type="email" name="email" class="form-control" id="yourEmail" required>
                  <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                </div>

                <div class="col-12">
                  <label for="yourUsername" class="form-label"><strong> Username</strong></label>
                  <div class="input-group has-validation">
                    <span class="input-group-text bg-primary" id="inputGroupPrepend"><strong>@</strong></span>
                    <input type="text" name="username" class="form-control" id="yourUsername" required>
                    <div class="invalid-feedback">Please choose a username.</div>
                  </div>
                </div>

                <div class="col-12">
                  <label for="yourPassword" class="form-label"><strong>Password</strong></label>
                  <input type="password" name="password" class="form-control" id="yourPassword" required>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>

                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms"><strong> agree and accept the </strong><a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
                </div>
                <div class="col-12">
                  <button class="btn btn-primary w-100" type="submit">Create Account</button>
                </div>
                <div class="col-12">
                  <p class="small mb-0"><strong> Already have an account? </strong><a href="login.php">Log in</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
  </main><!-- End #main -->
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>