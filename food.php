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
    date_default_timezone_set('Asia/Dhaka');
    $dates = date('Y-m-d H:i:s');
    $var_uid = $_SESSION['c_userid'];
    $rfood_id = $_SESSION['rfood_id'];
    $var_fid = $_POST['food_id'];
    $var_rid = $_POST['res_id'];
    $var_price = $_POST['fd_price'];

    if (isset($_POST['add'])) {

        $sql = "INSERT INTO `orders`(`userid`, `food_id`, `res_id`, `status`, `amount`, `price`, `time`) 
            VALUES ('$var_uid','$var_fid','$var_rid','1',1,'$var_price','$dates')";
        $query_result = mysqli_query($conn, $sql);
        header("location: food.php");
    }


    $var_text = $_POST['reviewtext'];


    echo $var_uid;

    if (isset($_POST['frate'])) {
        if (!empty($_POST['ratings'])) {
            $var_rate = $_POST['ratings'];
        }
        $sql = "UPDATE `orders` SET  `status`='4',`rating`='$var_rate',`review`='$var_text' WHERE `userid`='$var_uid' AND `food_id`='$rfood_id ' AND `status`='3'";
        $result = mysqli_query($conn, $sql);
        echo ("<meta http-equiv='refresh' content='1'>");
        header("Refresh:1");
        header("location: food.php");
    }


    ?>

    <section style="padding-top: 100px;" class="container">
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php



                                    $query = "SELECT * FROM `fooddetail` WHERE `food_id`='$rfood_id'";
                                    $result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $var_resid = $row['restaurant_id'];
                                        $query3 = "SELECT * FROM restaurant WHERE `restaurant_id`='$var_resid'";
                                        $result3 = mysqli_query($conn, $query3);
                                        $row3 = mysqli_fetch_array($result3);
                                    ?>

                                        <div class="row">
                                            <div class="col-md-4" ">
                                        <img style=" width: 300px;" src="<?php echo $row['food_img'] ?>">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3 style="margin-top: 20px;"><?php echo $row['restaurant_name'] ?></h3>
                                                <br>
                                                <h5><b>Name : </b><?php echo $row['food_name'] ?></h5>
                                                <h6><b>Restaurant: </b> <?php echo $row3['restaurant_name']; ?></h6>
                                                <p><b>Type : </b> <?php echo $row['food_type'] ?></p>
                                                <p><b>Cuisine: </b> <?php echo $row['food_cuisine'] ?></p>
                                                <p><b>Price: </b> <?php echo $row['food_price'] ?></p>

                                                <form method="POST">
                                                    <input type="hidden" name="food_id" value="<?php echo $row['food_id'] ?>">
                                                    <input type="hidden" name="res_id" value="<?php echo $row['restaurant_id'] ?>">
                                                    <input type="hidden" name="fd_price" value="<?php echo $row['food_price'] ?>">
                                                    <button type="submit" name="add" class="btn btn-primary" style="margin-right: 20px; margin-top:20px;">Add to cart</button>
                                                    <button type="button" class="btn btn-success" onclick="myFunction()" style="margin-right: 20px; margin-top:20px;">Review</button>
                                                </form>

                                            </div>

                                            <div class="col-md-8 " id="review" ">
                                            <br>
                                            <br>
                                                <form method="POST">
                                                    <div class="col-md-4 form-group">
                                                        <label for="exampleFormControlSelect1">Rate</label>
                                                        <select name="ratings" class="form-control" id="exampleFormControlSelect1">
                                                            <option>5</option>
                                                            <option>4</option>
                                                            <option>3</option>
                                                            <option>2</option>
                                                            <option>1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <label for="exampleFormControlTextarea1">Enter Review</label>
                                                        <textarea name="reviewtext" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                    </div>
                                                    <button name="frate" type="submit" class="btn btn-primary">Save</button>

                                                </form>

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
            </div>
        </div>

    </section>

    <section style="padding-top: 100px;" class="container">
        <div class="container" style="margin-top:10px;">
            <h3>Other Reviews</h3>
            <div class="row">
                <div class="col-12">
                    <div class="card card-margin">
                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-4">
                                <h4 style="margin-left: 30px;">Name</h4>
                            </div>
                            <div class="col-md-4">
                                <h4 style="margin-left: 50px;">Rating</h4>
                            </div>
                            <div class="col-md-4">
                                <h4>Review</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row search-body">
                                <div class="col-lg-12">
                                    <div class="result-body">
                                        <div class="table-responsive">
                                            <table class="table widget-26">

                                                <?php

                                                $query = "SELECT * FROM orders WHERE `status`='4' AND `food_id`='$rfood_id'";
                                                $result = mysqli_query($conn, $query);
                                                $check_res = mysqli_num_rows($result) > 0;
                                                if ($check_res) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                        <tr>
                                                            <td style="width: 30%;">
                                                                <h6><?php echo $row['userid'] ?></h6>
                                                            </td>
                                                            <td style="width: 30%;padding-left:80px;">
                                                                <p><?php echo $row['rating'] ?></p>
                                                            </td>
                                                            <td style="width: 30%;">
                                                                <p><?php echo $row['review'] ?></p>
                                                            </td>
                                                        </tr>

                                                <?php
                                                    }
                                                }

                                                ?>
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
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Foodbee | Copyright &copy; 2021. All rights reserved.</small>
                <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
            </div>
        </div>
    </section>


    <script>
        function myFunction() {
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