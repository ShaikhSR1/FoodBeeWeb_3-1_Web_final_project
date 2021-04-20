<?php
session_start();
if (!isset($_SESSION['adminUsId'])) {
    header("location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Foodies Hub</title>
    <link rel="icon" href="../photos/icon1.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="css/adminstyle.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Lexend+Zetta&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    }
    ?>

    <section>
        <div class="sidebar">
            <div class="admin-header">
                <img src="../<?php echo $_SESSION['dp'] ?>" alt="admin">
                <h2><?php echo $_SESSION['adminName'] ?></h2>
                <form method="POST">
                    <button class="btn btn-secondary" style="margin-left: 20px;" name="logout">Logout</button>
                </form>
            </div>
            <?php
            if (isset($_POST['logout'])) {
                session_destroy();
                header("location: login.php");
            }
            ?>

            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="restadmin.php">Restaurant</a></li>
                <li><a href="riders.php">Riders</a></li>
                <!--<li><a>Employees</a></li>
                <li><a>Reports</a></li>
                <li><a>Users</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a>Users</a></li>-->

            </ul>
        </div>
    </section>

    <section class="rstrnt">
        <div class="cont">
            <div class="cont-header">
                <h2>Restaurants</h2>
            </div>
        </div>



        <div class="container" id="res_det">
            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card card-6">

                        <?php

                        $res = $_SESSION['res'];

                        $query = "SELECT * FROM restaurant WHERE restaurant_id='$res'";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {

                        ?>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 resdet">
                                        <img src="../<?php echo $row['restaurant_img'] ?>">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 resdet4">
                                        <h3 style="margin-top: 20px;"><?php echo $row['restaurant_name'] ?></h3>
                                        <br>
                                        <p><b>Restaurant ID:</b><?php echo $row['restaurant_name'] ?></p>
                                        <p><b>Location :</b> <?php echo $row['area'] ?></p>
                                        <p><b>Available :</b> <?php echo $row['available_time'] ?></p>
                                        <p><?php echo $row['manager_contact'] ?></p>
                                    </div>
                                    <div class="col-md-4 resdet2">

                                    </div>
                                    <div class="col-md-4 resdet3">
                                        <form method="POST">
                                            <button type="button" class="btn btn-primary" onclick="myFunction()" style="margin-right: 20px; margin-top:20px;">Edit</button>
                                            <button type="submit" name="remove" class="btn btn-danger" style="margin-right: 20px; margin-top:20px;">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--<button type="button" class="btn btn-primary" onclick="myFunction()" style="margin-left: 80px; margin-top:20px; margin-bottom: 20px;">Add Restaurants</button>-->
    </section>


    <?php

    if (isset($_POST['remove'])) {
        $sql = "DELETE FROM `restaurant` WHERE restaurant_id='$res'";
        $result = mysqli_query($conn, $sql);
        header("Location: restadmin.php");
        error_reporting(0);
    }

    ?>




    <?php

    if (isset($_POST['edt_res'])) {
        $file = $_FILES['file'];
        #print_r($file);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];


        $res_nm = $_POST['res_nm'];
        $res_loc = $_POST['res_loc'];
        $mng_inf = $_POST['mng_inf'];
        $avl_tm = $_POST['avl_tm'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 90000000) {
                    $fileDestination = 'uploads/' . $fileName;
                    move_uploaded_file($fileTmpName, '../' . $fileDestination);
                    header("Location: restdetails.php?uploadsuccess");
                } else {
                    echo "File size too big";
                }
            } else {
                echo "There was an error uploading your file";
            }
        } else {
            echo "You can not upload files of this type";
        }

        $sql = "UPDATE `restaurant` SET `restaurant_name`='$res_nm',`area`='$res_loc',`manager_contact`='$mng_inf',
        `available_time`='$avl_tm',`restaurant_img`='$fileDestination' WHERE restaurant_id='$res'";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


    ?>


    <section class="edit_rest">
        <center>
            <h3>Restaurant Menus</h3>
        </center>
        <div class="container" id="edit_res" style="display: none;">

            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card">
                        <div class="card-6">
                            <h3 style="margin-left: 20px; margin-top:20px;">Edit Restaurant Informations</h3>
                            <form style="padding: 20px;" action="restdetails.php" class="rest-enter" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="restaurant_name" name="res_nm" placeholder="Restaurant Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="res_area" name="res_loc" placeholder="Restaurant Location">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="manager_contact" name="mng_inf" placeholder="Manager Info">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="available_time" name="avl_tm" placeholder="Available Time">
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="file" id="file"><br>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" name="edt_res">Update</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="food_list" id="food_list">
        <div class="container">
            <div class="row">
                <div class="card-deck">
                    <?php
                    $queryfood = "SELECT * FROM fooddetail WHERE restaurant_id='$res'";
                    $resultfood = mysqli_query($conn, $queryfood);
                    while ($foodrow = mysqli_fetch_array($resultfood)) {
                    ?>
                        <div class="col-md-4" style="margin-bottom: 20px;">
                            <div class="card">
                                <img class="card-img-top" src="../<?php echo $foodrow['food_img'] ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $foodrow['food_name'] ?></h5>
                                    <h6 class="card-title"><?php echo $foodrow['food_type'] ?></h6>
                                    <p class="card-title"><?php echo $foodrow['food_cuisine'] ?></p>
                                    <p class="card-text">Available: <?php echo $foodrow['max_quantity'] ?></p>
                                    <p class="card-text">Unit Price: <?php echo $foodrow['food_price'] ?></p>
                                </div>
                                <!--<div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
                            </div>-->
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        function myFunction() {
            var x = document.getElementById("edit_res");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

</body>

</html>