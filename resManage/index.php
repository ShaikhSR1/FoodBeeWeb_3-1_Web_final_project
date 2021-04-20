<?php
session_start();
if (!isset($_SESSION['res_id'])) {
    header("location: login.php");
}
?>

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

    <nav style="padding-left:50px;padding-right:50px;" class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#home">
            <img src="../photos/Food Bee1.png" width="125px" alt="FOODBEE">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <form method="POST" class="form-inline">
                <button class="btn btn-sm btn-outline-secondary" name="logout">Logout</button>
            </form>
        </div>
        <?php
        if (isset($_POST['logout'])) {
            session_destroy();
            header("location: login.php");
        }
        ?>
    </nav>

    <section id="home">
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card">
                <div class="row d-flex">
                    <div class="col-lg-12">
                        <div class="card-6">

                            <?php
                            $res = $_SESSION['res_id'];
                            $query = "SELECT * FROM restaurant WHERE restaurant_id='$res'";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {

                            ?>
                                <div class="container">

                                    <div class="row">
                                        <div class="col-md-4 resdet">
                                            <img style="width:400px;" src="../<?php echo $row['restaurant_img'] ?>">
                                        </div>
                                        <div class="col-md-4 resdet2">

                                        </div>
                                        <div class="col-md-4 resdet3">

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 resdet4">
                                            <h3 style="margin-top: 20px;"><?php echo $row['restaurant_name'] ?></h3>
                                            <br>
                                            <p><b>Location :</b> <?php echo $row['area'] ?></p>
                                            <p><b>Available :</b> <?php echo $row['available_time'] ?></p>
                                            <p><b>Restaurant ID :</b> <?php echo $row['restaurant_id'] ?></p>
                                            <p><?php echo $row['manager_contact'] ?></p>
                                            <form action="restdetails.php" method="POST">
                                                <button type="button" class="btn btn-secondary" onclick="myFunction()" style="margin-right: 20px; margin-top:20px;">Edit Info</button>
                                                <button type="button" class="btn btn-primary" onclick="myFunction2()" style="margin-right: 20px; margin-top:20px;">Add Food</button>
                                            </form>
                                            <br><br><br>
                                        </div>

                                        <div class="col-md-8">
                                            <div id="edit_res" style="display: none;">
                                                <h3 style="margin-left: 20px; margin-top:20px;">Edit Restaurant Informations</h3>
                                                <form style="padding: 20px;" action="index.php" class="rest-enter" method="POST" enctype="multipart/form-data">
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
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" name="file" id="file"><br><br>
                                                        <button class="btn btn-primary" type="submit" name="edt_res">Update</button>

                                                    </div>
                                                    <br>

                                                </form>

                                            </div>
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
        </div>
    </section>

    <?php

    if (isset($_POST['dlt_fd'])) {
        $var = $_POST['food_id'];
        $sql = "DELETE FROM fooddetail WHERE food_id='$var' ";
        $query = mysqli_query($conn, $sql);
        
    }


    ?>



    <?php
if (isset($_POST['add_fd'])) {
    $file = $_FILES['file'];
    #print_r($file);
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fd_id = $_POST['food_id'];
    $fd_nm = $_POST['food_name'];
    $fd_tp = $_POST['food_type'];
    $fd_cs = $_POST['food_cuisine'];
    $fd_pr = $_POST['food_price'];
    $mx_qt = $_POST['max_quantity'];


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
            } else {
                echo "File size too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
    } else {
        echo "You can not upload files of this type";
    }

    $sql = "INSERT INTO `fooddetail` (`food_id`, `food_name`, `food_type`, `food_cuisine`, `food_price`, `max_quantity`, `restaurant_id`, `food_img`) 
            VALUES ('$fd_id','$fd_nm','$fd_tp','$fd_cs','$fd_pr','$mx_qt','$res','$fileDestination')";
    echo ("<meta http-equiv='refresh' content='1'>");
    header("Refresh:1");
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        # echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

    ?>

    <section style="margin-top: 20px;" class="add_food" style="display: none;">
        <div class="container" id="addfood" style="display: none;">
            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card">
                        <div class="card-6">
                            <h3 style="margin-left: 20px; margin-top:20px;">Add Food Information</h3>
                            <form action="index.php" style="padding: 20px;" class="food-enter" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="food_name" name="food_name" placeholder="Food Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="res_area" name="food_type" placeholder="Food Type">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="manager_contact" name="food_cuisine" placeholder="Food Cuisine">
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="food_id" name="food_id" placeholder="Food Id">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="food_price" name="food_price" placeholder="Food Price">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="max_quantity" name="max_quantity" placeholder="Max Quantity..">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="custom-file">
                                        <input type="file" name="file" id="file"><br>
                                    </div>
                                </div>
                                <button style="margin-top: 20px;" class="btn btn-primary" type="submit" name="add_fd">Update</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


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
                    header("Location: index.php?uploadsuccess");
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

        echo ("<meta http-equiv='refresh' content='1'>");
        header("Refresh:1");

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


    ?>

    <section class="food_list" id="food_list">
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card" style="max-width: 1200px;margin: auto;">
                <div class="row-fluid" style="padding: 2rem;">
                    <div class="card-group ">
                        <?php
                        $queryfood = "SELECT * FROM fooddetail WHERE restaurant_id='$res'";
                        $resultfood = mysqli_query($conn, $queryfood);
                        while ($foodrow = mysqli_fetch_array($resultfood)) {
                        ?>
                            <div class="col-md-4" style="margin-bottom:2rem;">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../<?php echo $foodrow['food_img'] ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $foodrow['food_name'] ?></h5>
                                        <h6 class="card-title"><?php echo $foodrow['food_type'] ?></h6>
                                        <p class="card-title"><?php echo $foodrow['food_cuisine'] ?></p>
                                        <p class="card-text">Available: <?php echo $foodrow['max_quantity'] ?></p>
                                        <p class="card-text">Unit Price: <?php echo $foodrow['food_price'] ?></p>
                                        <form method="POST">
                                            <input type="hidden" name="food_id" value="<?php echo $foodrow['food_id'] ?>">
                                            <button style="margin-top: 20px;" class="btn btn-danger" type="submit" name="dlt_fd">Delete</button>
                                        </form>
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

        function myFunction2() {
            var x = document.getElementById("addfood");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</body>

</html>