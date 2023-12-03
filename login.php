<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<style>
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

    .err {
        color: red;
    }

    .invalid-password {
        border: 1px solid red;
    }
</style>

<body>

    <?php
    $email = $pass = $err = "";
    $emailwar = $passwordwar = "";
    // error_reporting(0);
    $err = "Enter valid E-mail or Password";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (empty($_POST["myemail"])) {
            $emailwar = "Enter your email";
        } else {
            $email = data($_POST["myemail"]);
        }
        if (empty($_POST["pass"])) {
            $passwordwar = "Please Enter your password";
        } else {
            $pass = data($_POST["pass"]);
        }
        if ($pass >= 6 && $pass <= 10) {
            $pass = $password;
        } else {
            $passwordwar = "Password must be 6 to 10 characters long";
        }
    }
    function data($info)
    {
        $info = trim($info);
        $info = htmlspecialchars($info);
        $info = stripslashes($info);
        return $info;
    }
    ?>
    <section class="text-center w-100">

        <!-- Background image -->

        <!-- Background image -->

        <div class="card mx-4 mx-md-5 shadow-5-strong" style="
    
      background: rgba(33, 33, 33, 0);
      backdrop-filter: blur(60px);
      ">
            <div class="card-body py-5 px-md-5">

                <div class="row d-flex justify-content-center">

                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-5">Login to your Account</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                            <!-- Email input -->
                            <div class="input-group flex-nowrap mb-4">
                                <span class="input-group-text text-light bg-primary" id="addon-wrapping"><strong>E-mail</strong></span>
                                <input type="email" class="form-control" name="myemail" placeholder="username@gmail.com" aria-label="E-mail" aria-describedby="addon-wrapping" required>
                            </div>

                            <div class="input-group flex-nowrap mb-4">
                                <span class="input-group-text text-light bg-primary" id="addon-wrapping"><strong>Password</strong></span>
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="*  *  *  *  *  *  *" aria-label="Password" aria-describedby="addon-wrapping" required>
                            </div>





                            <a href="home.php"> <input type="submit" name="Login" value="Login" class="btn btn-primary btn-block mb-4" /></a><br>
                            New account?<a href="sign.php"> Signin now</a><br>



                            <div class="err">


                                <?php
                                include 'db_connect.php';
                                if (array_key_exists('Login', $_POST)) {
                                    if (!empty($email) && !empty($pass)) {
                                        $sql = "SELECT * FROM info WHERE email = '$email' AND password = md5('$pass') limit 1";
                                    }
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {


                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $_SESSION['firstname'] = $row["firstname"];
                                            $_SESSION['lastname'] = $row["lastname"];
                                            $_SESSION['email'] = $row["email"];
                                            echo "<script>alert('welcome, " . $row['firstname'] . " " . $row["lastname"] . "')</script>";
                                        }
                                        echo '<script> window.location.href = "home.php";</script>';
                                    } else {
                                        echo "Enter valid E-mail or Password";
                                    }
                                    mysqli_close($conn);
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>