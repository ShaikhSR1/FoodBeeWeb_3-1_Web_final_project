<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Foodies Hub</title>
    <link rel="icon" href="../photos/icon1.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Lexend+Zetta&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodbee";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        #echo "Connected";
    } ?>


    <!-- <div class="login-form">
        <h2>Admin Login Panel</h2>
        <form method="POST">
            <div class="input-field">
                <i class="fas fa-suer"></i>
                <input type="txt" name="userid" placeholder="Admin Userid">
            </div>

            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="txt" name="password" placeholder="Admin Userid">
            </div>

            <button type="submit" name="signin">Sign In</button>

        </form>
    </div>-->


    <?php

    if (isset($_POST['signin'])) {
        $query = "SELECT * FROM restaurant WHERE restaurant_id='$_POST[resid]' AND pass='$_POST[password]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) == 1) {
            session_start();
            $_SESSION['res_id'] = $_POST['resid'];
            header("location: index.php");
        } else {
            echo "<script>alert('Incorrect Username or Password');</script>";
        }
    }

    ?>

    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row"> <img src="../photos/Food Bee1.png" style="margin-top: 10px; margin-left:20px;" width="125px" alt="FOODBEE"> </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <h3 style="margin-top: 30px; margin-bottom:100px;">Restaurant Manager Panel Login</h3>

                            <img src="../photos/manager.png" class="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <form method="POST">
                            <div class="row px-3 mb-4">
                                <div class="line" style="margin-top:30px;margin-bottom: 100px;"></div>
                                <h6 class="or text-center" style="margin-top:21px;margin-bottom: 100px;">Login</h6>
                                <div class="line" style="margin-top:30px;margin-bottom: 100px;">
                                </div>
                            </div>
                            <div class=" row px-3"> <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Restaurant ID</h6>
                                </label> <input class="mb-4" type="text" name="resid" placeholder="Enter Restaurant ID"> </div>
                            <div class="row px-3"> <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Password</h6>
                                </label> <input type="password" name="password" placeholder="Enter password"> </div>
                            <div class="row px-3 mb-4">
                                <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit" name="signin" class="btn btn-primary text-center">Login</button> </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2021. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>