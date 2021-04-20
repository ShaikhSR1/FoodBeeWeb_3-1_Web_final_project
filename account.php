<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Foodies Hub</title>
    <link rel="icon" href="photos/icon1.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="resmanage/css/login.css">
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/bootstrap.css">

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

    <?php
    require_once("./header.php");
    if (isset($_POST['login'])) {
        $cuser_id = $_POST['cuser_id'];
        #echo $cuser_id;
        $c_pass = $_POST['c_pass'];
        $query = "SELECT * FROM account WHERE username='$cuser_id' AND pass='$c_pass'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['c_userid'] = $cuser_id;
            header("location: index.php");
        } else {
            echo "<script>$cuser_id</script>";
        }
    }

    if (isset($_POST['signup'])) {
        $cr_userid = $_POST['cuserid'];
        $cr_name = $_POST['c_name'];
        $cr_phone = $_POST['c_phone'];
        $cr_pass = $_POST['c_pass'];
        $sql = "INSERT INTO `account`(`username`, `name`, `phone`, `pass`) VALUES ('$cr_userid','$cr_name','$cr_phone','$cr_pass')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['c_userid'] = $cr_userid;
            header("location: index.php");
        }
    }

    if (isset($_SESSION['c_userid'])) {
        header("location: profile.php");
    }


    ?>


    <section style="padding-top: 30px;">
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <div class="row"> <img src="photos/Food Bee1.png" style="margin-top: 10px; margin-left:20px;" width="125px" alt="FOODBEE"> </div>
                            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                                <h3 style="margin-top: 30px; margin-bottom:100px;">User Login</h3>

                                <img src="photos/login.png" class="image">
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
                                        <h6 class="mb-0 text-sm">User ID</h6>
                                    </label> <input class="mb-4" type="text" name="cuser_id" placeholder="Enter User ID"> </div>
                                <div class="row px-3"> <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Password</h6>
                                    </label> <input type="password" name="c_pass" placeholder="Enter password"> </div>
                                <div class="row px-3 mb-4">
                                    <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                                </div>
                                <div class="row mb-3 px-3">
                                    <button type="submit" name="login" class="btn btn-primary btn-lg text-center">Login</button>
                                    <span style="margin-top: 5px;margin-left:10px;"><a href="#signup">
                                            <h4>Don't have account? Register</h4>
                                        </a></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-blue py-4">
                </div>
            </div>
        </div>
        </div>
    </section>


    <!---- Register -------------->

    <section style="padding-top: 30px;" id="signup">
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <div class="row"> <img src="photos/Food Bee1.png" style="margin-top: 10px; margin-left:20px;" width="125px" alt="FOODBEE"> </div>
                            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                                <h3 style="margin-top: 30px; margin-bottom:100px;">Register</h3>

                                <img src="photos/signup.png" class="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card2 card border-0 px-4 py-5">
                            <form method="POST">
                                <div class="row px-3 mb-4">
                                    <div class="line" style="margin-top:30px;"></div>
                                    <h6 class="or text-center" style="margin-top:21px;">Sign Up</h6>
                                    <div class="line" style="margin-top:30px;">
                                    </div>
                                </div>
                                <div class=" row px-3">
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm">User ID</h6>
                                    </label>
                                    <input class="mb-4" type="text" name="cuserid">
                                </div>
                                <div class="row px-3">
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Password</h6>
                                    </label>
                                    <input type="password" name="c_pass">
                                </div>
                                <div class="row px-3">
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Name</h6>
                                    </label>
                                    <input class="mb-4" type="text" name="c_name">
                                </div>
                                <div class="row px-3">
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Phone</h6>
                                    </label>
                                    <input class="mb-4" type="text" name="c_phone">
                                </div>

                                <div class="row mb-3 px-3">
                                    <button type="submit" name="signup" class="btn btn-primary btn-lg text-center">Sign Up</button>
                                </div>
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
    </section>

</body>

</html>