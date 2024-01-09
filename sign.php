<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Creat Your Account</title>
  <!-- Include Bootstrap CSS -->
  
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
   
    height: 100vh;
    background-image: url("bg.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }

</style>

<body>
<?php
// Initialize variables
$name = $email = $username = $password = $pass = "";
$passwordwar = "";

// Function to sanitize user input
function sanitize($info)
{
    
    $info = htmlspecialchars($info);
  
    return $info;
}

// Form validation and data handling
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['submit'])){
            $name = sanitize($_POST["name"]);
            $user = sanitize($_POST["username"]);
            $email = sanitize($_POST["email"]);
        $password = sanitize($_POST["password"]);
        $passwordLength = strlen($password);
        if ($passwordLength >= 6 && $passwordLength <= 10) {
          $pass = MD5($password); // Hash the password
        } else {
            $passwordwar = "Password must be 6 to 10 characters long";
        }
    

    require_once 'db_connect.php';

         $checkEmail = "SELECT * FROM info WHERE email = '$email'";
        $resultEmail = mysqli_query($conn, $checkEmail);
        if (mysqli_num_rows($resultEmail) > 0) {
            echo "<script>alert('E-mail already exists')</script>";
        }
             $checkUsername = "SELECT * FROM info WHERE username = '$user'";
             $resultUsername = mysqli_query($conn, $checkUsername);
       if (mysqli_num_rows($resultUsername) > 0) {
               echo "<script>alert('Username already exists')</script>";
          }
  
       else{
            $sql = "INSERT INTO info (name, email, username, password) VALUES ('$name', '$email','$user' ,'$pass')";
           
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Sign-up successful')</script>";
               echo '<script>window.location.href = "login.php";</script>';

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
          
          }
        }
        mysqli_close($conn);
   // Close the database connection
        }
?>


  <main> 
  <div class="container">

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">


      <div class="card mb-3 shadow-7-strong" style="background: rgba(0,0,0,0.1); backdrop-filter: blur(70px);">

          <div class="card-body">
              <div class="pt-4 pb-2">
                <h4 class="card-title text-center pb-0 fs-4">Create an Account</h4>
                <p class="text-center small">Enter your personal details to create account</p>
              </div>

              <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                <div class="col-12">
                  <label for="yourName" class="form-label"><strong>Your Name</strong></label>
                  <input type="text" name="name"  class="form-control" id="name" required>
                  <div class="invalid-feedback">Please, enter your name!</div>
                </div>
                <div class="col-12">
                  <label for="yourUsername" class="form-label"><strong> Username</strong></label>
                  <div class="input-group has-validation">
                   
                    <input type="text" name="username" class="form-control" id="username" required>
                    <div class="invalid-feedback">Please choose a username.</div>
                  </div>
                </div>
                <div class="col-12">
                  <label for="yourEmail" class="form-label"><strong>Your E-mail</strong> </label>
                  <input type="email" name="email"  class="form-control" id="email" placeholder="username@abc.com" required>
                  <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                </div>

              

                <div class="col-12">
                  <label for="yourPassword" class="form-label"><strong>Password</strong></label>
                  <input type="password" name="password" class="form-control <?php echo (!empty($passwordwar)) ? 'invalid-password' : ''; ?>" id="password" required>
                  <div class="invalid-feedback"> Enter strong valid password </div>
                </div>
               
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                    <label class="form-check-label" for="acceptTerms"><strong> agree and accept the </strong><a href="#">terms and conditions</a></label>
                    <div class="invalid-feedback">You must agree before submitting.</div>
                  </div>
                </div>
                <div class="col-12">
               
                <input class="btn btn-primary w-100" type="submit" name="submit" value="Create Account">
                </div>
                <div class="col-12">
                  <p class="small mb-0"><strong> Already have an account? </strong><a href="login.php">Log in</a></p>
                </div>
              </form>
              </div>
              </div>
            </div>
          </div>
        </div>

      </section>

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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- <script>
  'function reset(){
alert(“javascript called”);
document.getElementById(“fname”).value=“”;
document.getElementById(“mname”).value=“”;
document.getElementById(“lname”).value=“”;
document.getElementById(“email”).value=“”;
  }'
  </script> -->
</body>

</html>