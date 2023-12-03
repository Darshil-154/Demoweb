</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
    } else {
      // echo "<script>alert('Please fill in all required fields.')</script>";

    }

    mysqli_close($conn); // Close the database connection
  }
  ?>

  <!-- Section: Design Block -->
  <section class="text-center w-100">
    <!-- Background image -->

    <!-- Background image -->

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="background: rgba(33,33 ,33 , 0); backdrop-filter: blur(60px);">
      <div class="card-body py-4 px-md-4">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5" style="color: black;">Sign up now</h2>

            <!-- Registration Form -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="row">
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1" class="form-control" name="myfname" placeholder="First name" required>

                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example2" class="form-control" name="mylname" placeholder="Last name">

                    </div>
                  </div>
                  <div class="input-group flex-nowrap mb-4">
                    <span class="input-group-text text-light bg-primary" id="addon-wrapping"><strong>DOB</strong></span>
                    <input type="date" class="form-control" name="mydob" aria-label="DOB" aria-describedby="addon-wrapping" required>
                  </div>

                  <div class="input-group mb-4">
                    <label class="input-group-text text-light bg-primary" for="inputGroupSelect01"><strong>Gender</strong></label>
                    <select class="form-select" id="inputGroupSelect01">
                      <option selected>Choose...</option>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                      <option value="3">Others</option>
                    </select>
                  </div>
                  <!-- Email input -->
                  <div class="input-group flex-nowrap mb-4">
                    <span class="input-group-text text-light bg-primary" id="addon-wrapping"><strong>E-mail</strong></span>
                    <input type="email" class="form-control" name="myemail" placeholder="username@gmail.com" aria-label="E-mail" aria-describedby="addon-wrapping" required>
                  </div>

                  <br>
                  <!-- Password input -->
                  <div class="input-group flex-nowrap mb-4">
                    <span class="input-group-text text-light bg-primary" id="addon-wrapping"><strong>Password</strong></span>
                    <input type="password" class="form-control <?php echo (!empty($passwordwar)) ? 'invalid-password' : ''; ?>" id="pass" name="pass" placeholder="*  *  *  *  *  *  *" aria-label="Password" aria-describedby="addon-wrapping" required>
                  </div>

                  <?php if (!empty($passwordwar)) : ?>
                    <div style="color: red;"><?php echo $passwordwar; ?></div>
                  <?php endif; ?>

                  <br>

                  <!-- Checkbox -->
                  <div class="form-check d-flex justify-content-center mb-4">
                    <input class="form-check-input me-2" type="checkbox" value="check" id="form2Example33">
                    <label class="form-check-label" for="form2Example33" style="color:white" script='  let checkbox = document.getElementById("form2Example33");
      checkbox.addEventListener( "change", () => {
         if ( checkbox.checked ) {
            
         } else {
          alert("Accept Terms and Conditions")
         }' require>
                      Accept Terms and conditions
                    </label>

                  </div>
                  <a href="login.php"><input type="submit" name="Signup" value="Signup" class="btn btn-primary btn-block mb-4" /></a>
            </form>
            <!-- End Registration Form -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Include Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>