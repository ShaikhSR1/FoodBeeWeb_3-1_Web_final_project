<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Foodies Hub</title>
    <link rel="icon" href="photos\icon1.jpg" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="css\navstyle.css">
    <link rel="stylesheet" href="css\bootstrap.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Lexend+Zetta&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="jquery.autocomplete.js"></script>
</head>

<body>
    <!---------------------------PHP PART---------------------------->

    <?php
    require_once("./header.php");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodbee";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $acc = $_SESSION['c_userid'];
    $query = "SELECT * FROM account WHERE username='$acc'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $phone = $row['phone'];
        $user = $row['username'];
        $pass = $row['pass'];
    }



    if (isset($_POST['edt_inf'])) {
        $ed_name = $_POST['ename'];
        $ed_pass = $_POST['epass'];
        $ed_phone = $_POST['ephone'];



        $sql = "UPDATE `account` SET `name`='$ed_name',`phone`='$ed_phone',`pass`='$ed_pass' WHERE `username`='$acc'";

        $result = mysqli_query($conn, $sql);

        header("location: profile.php");
    }

    if (isset($_POST['fd_det'])) {
        $_SESSION['rfood_id'] = $_POST['rfood_id'];
        header("location: food.php");
    }


    ?>
    <section class="container">

    </section>



    <section style="padding-top: 100px;" class="container">
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <h2>Hi, <?php echo $name ?></h2>
                                    <form method="POST">
                                        <button type="button" class="btn btn-secondary" onclick="myFunction()" style="margin-right: 20px; margin-top:20px;">Edit Info</button>
                                        <button type="button" class="btn btn-primary" onclick="myFunction2()" style="margin-right: 20px; margin-top:20px;">My Orders</button>
                                        <button class="btn btn-danger" style="margin-right: 20px; margin-top:20px;"" name=" logout">Logout</button>
                                    </form>
                                    <?php
                                    if (isset($_POST['logout'])) {
                                        session_destroy();
                                        header("location: account.php");
                                    }
                                    ?>
                                </div>

                                <div class="col-md-8">
                                    <div id="edit_inf" style="display: none;">
                                        <h3 style="margin-left: 20px; margin-top:20px;">Edit Your Informations</h3>
                                        <form style="padding: 20px;" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" id="ed_name" name="ename" placeholder="Name">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" id="ed_phone" name="ephone" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" id="ed_pass" name="epass" placeholder="Password">
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="submit" name="edt_inf">Update</button>
                                            <br>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container" id="Orders" style="margin-top:10px;">
        <button type="button" class="btn btn-warning" onclick="myFunction3()" style="margin-left: 10px; margin-top:20px;">Pending Orders</button>
        <button type="button" class="btn btn-success" onclick="myFunction4()" style="margin-left: 20px; margin-top:20px;">Received Orders</button>
        <button type="button" class="btn btn-dark" onclick="myFunction5()" style="margin-left: 20px; margin-top:20px;">All Orders</button>
        <br><br>
        <div class="container" id="ordp">
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <div class="search-result">
                                        <div class="result-header">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="records">
                                                        <!--Showing: <b>1-20</b> of <b>200</b> result-->
                                                        <h4 style="color:white;border-radius:5px;padding:5px;text-align:center;width: 200px;background: #ffc107; height:40px;">Pending Orders</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM orders WHERE `status`='2' AND `userid`='$acc'";
                                                        $result = mysqli_query($conn, $query);
                                                        $check_res = mysqli_num_rows($result) > 0;
                                                        if ($check_res) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $var_foodid = $row['food_id'];
                                                                $var_resid = $row['res_id'];

                                                                $query2 = "SELECT * FROM fooddetail WHERE `food_id`='$var_foodid'";
                                                                $result2 = mysqli_query($conn, $query2);
                                                                $row2 = mysqli_fetch_array($result2);

                                                                $query3 = "SELECT * FROM restaurant WHERE `restaurant_id`='$var_resid'";
                                                                $result3 = mysqli_query($conn, $query3);
                                                                $row3 = mysqli_fetch_array($result3);
                                                        ?>

                                                                <tr>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <h6><?php echo $row['userid']; ?></h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row2['food_name']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row3['restaurant_name']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['time']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['amount']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-salary"><?php echo $row['price']; ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['location']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-category ">
                                                                            <form method="POST">
                                                                                <input type="hidden" name="rfood_id" value="<?php echo $row['food_id'] ?>">
                                                                                <input type="hidden" name="ruser_id" value="<?php echo $row['userid'] ?>">
                                                                                <button name="fd_det" type="submit" class="btn btn-sm btn-outline-secondary">Details</button>
                                                                            </form>
                                                                        </div>
                                                                    </td>

                                                                </tr>
                                                        <?php
                                                            }
                                                        }

                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container" id="ordr" style="display: none;">
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <div class="search-result">
                                        <div class="result-header">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="records">
                                                        <!--Showing: <b>1-20</b> of <b>200</b> result-->
                                                        <h4 style="color:white;border-radius:5px;padding:5px;text-align:center;width: 200px;background: #28a745; height:40px;">Received</h4>
                                                        <h6>Please give a review</h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM orders WHERE `status`='3'  AND `userid`='$acc'";
                                                        $result = mysqli_query($conn, $query);
                                                        $check_res = mysqli_num_rows($result) > 0;
                                                        if ($check_res) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $var_foodid = $row['food_id'];
                                                                $var_resid = $row['res_id'];

                                                                $query2 = "SELECT * FROM fooddetail WHERE `food_id`='$var_foodid'";
                                                                $result2 = mysqli_query($conn, $query2);
                                                                $row2 = mysqli_fetch_array($result2);

                                                                $query3 = "SELECT * FROM restaurant WHERE `restaurant_id`='$var_resid'";
                                                                $result3 = mysqli_query($conn, $query3);
                                                                $row3 = mysqli_fetch_array($result3);
                                                        ?>

                                                                <tr>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <h6><?php echo $row['userid']; ?></h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row2['food_name']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row3['restaurant_name']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['time']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['amount']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-salary"><?php echo $row['price']; ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['location']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-category ">
                                                                            <form method="POST">
                                                                                <input type="hidden" name="rfood_id" value="<?php echo $row['food_id'] ?>">
                                                                                <input type="hidden" name="ruser_id" value="<?php echo $row['userid'] ?>">
                                                                                <button name="fd_det" type="submit" class="btn btn-sm btn-outline-success">Review</button>
                                                                            </form>
                                                                        </div>
                                                                    </td>

                                                                </tr>

                                                        <?php
                                                            }
                                                        }

                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container" id="orda" style="display: none;">
            <div class=" row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <div class="search-result">
                                        <div class="result-header">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="records">
                                                        <!--Showing: <b>1-20</b> of <b>200</b> result-->
                                                        <h4 style="color:white;border-radius:5px;padding:5px;text-align:center;width: 200px;background: #000; height:40px;">All Order List</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM orders WHERE `userid`='$acc'";
                                                        $result = mysqli_query($conn, $query);
                                                        $check_res = mysqli_num_rows($result) > 0;
                                                        if ($check_res) {
                                                            while ($row = mysqli_fetch_array($result)) {
                                                                $var_foodid = $row['food_id'];
                                                                $var_resid = $row['res_id'];

                                                                $query2 = "SELECT * FROM fooddetail WHERE `food_id`='$var_foodid'";
                                                                $result2 = mysqli_query($conn, $query2);
                                                                $row2 = mysqli_fetch_array($result2);

                                                                $query3 = "SELECT * FROM restaurant WHERE `restaurant_id`='$var_resid'";
                                                                $result3 = mysqli_query($conn, $query3);
                                                                $row3 = mysqli_fetch_array($result3);
                                                        ?>

                                                                <tr>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <h6><?php echo $row['userid']; ?></h6>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row2['food_name']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row3['restaurant_name']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['time']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['amount']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-salary"><?php echo $row['price']; ?></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row['location']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-category ">
                                                                            <form method="POST">
                                                                                <input type="hidden" name="rfood_id" value="<?php echo $row['food_id'] ?>">
                                                                                <input type="hidden" name="ruser_id" value="<?php echo $row['userid'] ?>">
                                                                                <button name="fd_det" type="submit" class="btn btn-sm btn-outline-secondary">Details</button>
                                                                            </form>
                                                                        </div>
                                                                    </td>

                                                                </tr>

                                                        <?php
                                                            }
                                                        }

                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        function myFunction() {
            var x = document.getElementById("edit_inf");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction2() {
            var x = document.getElementById("Orders");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction3() {
            var x = document.getElementById("ordp");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction4() {
            var x = document.getElementById("ordr");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction5() {
            var x = document.getElementById("orda");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction6() {
            var x = document.getElementById("review");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>


</body>

</html>