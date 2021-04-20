<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>FoodBee</title>
    <link rel="icon" href="photos\icon1.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="css\bootstrap.css">
    <link rel="stylesheet" href="css\navstyle.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="https://fonts.googleapis.com/css2?family=Lexend+Zetta&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <?php

    require_once("./header.php");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodbee";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    #echo "Connected successfully";

    //$res_id = $_SESSION['res_id'];
    date_default_timezone_set('Asia/Dhaka');
    $dates = date('Y-m-d H:i:s');

    $var_uid = $_SESSION['c_userid'];
    $var_fid = $_POST['food_id'];
    $var_rid = $_POST['res_id'];
    $var_price = $_POST['fd_price'];
    echo $var_price;
    if (isset($_POST['add'])) {

        if ($_SESSION['c_userid']) {

            $sql = "INSERT INTO `orders`(`userid`, `food_id`, `res_id`, `status`, `amount`, `price`, `time`) 
            VALUES ('$var_uid','$var_fid','$var_rid','1',1,'$var_price','$dates')";
            $query_result = mysqli_query($conn, $sql);
        } else {
            echo "<script>alert('Please Login')</script>";
            header("location: account.php");
        }
    }

    if (isset($_POST['fd_det'])) {
        $_SESSION['rfood_id'] = $_POST['food_id'];
        header("location: food.php");
    }

    $val = 0;


    ?>

    <!---------------End of Navbar------------------->



    <!--------------- Start of easy Guide ---------------->



    <!--------------- End of easy Guide ---------------->


    <!--------------- Start of Search ---------------->


    <section class="search2">
        <div class="search-header2">
            <h1>Search Your Food</h1>
            <h5>Find foods </h5>
        </div>
        <div class="search-box2">
            <form class="search-container2" action="foodlist.php" method="post">
                <input type="text" id="area" class="search-txt2" name="search" placeholder="I would like to eat..">
                <input type="submit" class="search-btn" value="Go &#8594;">
                <div id="area-list"></div>

            </form>

        </div>

    </section>

    <!--------------- End of Search ------------------->

    <!--------------------Food List-------------------------->

    <section class="home1">
        <h1 class="food-h1">Foods List... </h1>
        <br>
        <form action="foodlist.php" method="POST">
            <button style="margin-left: 40px; margin-bottom:10px;" name="allfood" type="submit" class="btn btn-lg btn-outline-dark">See all foods</button>
        </form>

    </section>

    <section>
        <div style="margin-bottom: 2rem;" class="container">
            <div class="card">
                <div class="row" style="padding: 2rem;">

                    <?php
                    $dataR = $_POST['restaurant_id'];
                    $queryR = "SELECT * FROM fooddetail WHERE restaurant_id LIKE '$dataR'";
                    $result = mysqli_query($conn, $queryR);
                    $check_result = mysqli_num_rows($result) > 0;
                    if (isset($_POST['restaurant_id'])) {
                        $val = 1;
                        if ($check_result) {
                            while ($row = mysqli_fetch_array($result)) {
                    ?>
                                <div class="col-md-4" style="padding:5px;margin-bottom:2rem;">

                                    <div class="col-lg-6">
                                        <img style="width:20rem" src="<?php echo "$row[food_img]" ?>">
                                    </div>
                                    <div class="col-lg-6">
                                        <h2><?php echo $row['food_name']; ?></h2>
                                        <h3><?php echo $row['food_type']; ?></h3>
                                        <h3><?php echo $row['food_price']; ?>/- TK</h3>
                                        <form method="POST">
                                            <input type="hidden" name="food_id" value="<?php echo $row['food_id'] ?>">
                                            <input type="hidden" name="res_id" value="<?php echo $row['restaurant_id'] ?>">
                                            <input type="hidden" name="fd_price" value="<?php echo $row['food_price'] ?>">
                                            <button class="btn btn-lg btn-primary" type="submit" name="add" class="order-btn-res">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                                            <button style="margin-top: 5px;" name="fd_det" type="submit" class="btn btn-lg btn-outline-secondary">Details</button>
                                        </form>
                                    </div>

                                </div>
                            <?php
                            }
                        }
                    }



                    if (isset($_POST['search'])) {

                        $data = $_POST['search'];
                        $datas = $data[0] . $data[1] . $data[2];
                        $query = "SELECT * FROM fooddetail WHERE food_type LIKE '$datas%' OR food_name LIKE '%$datas%'";
                        $result = mysqli_query($conn, $query);
                        $check_result = mysqli_num_rows($result) > 0;

                        if ($check_result) {
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <div class="col-md-6" style="padding:5px;margin-bottom:2rem;">

                                    <div class="col-lg-6">
                                        <img style="width:20rem" src="<?php echo "$row[food_img]" ?>">

                                    </div>
                                    <div class="col-lg-6">
                                        <h2><?php echo $row['food_name']; ?></h2>
                                        <h3><?php echo $row['food_type']; ?></h3>
                                        <h3><?php echo $row['food_price']; ?>/- TK</h3>
                                        <form method="POST">
                                            <input type="hidden" name="food_id" value="<?php echo $row['food_id'] ?>">
                                            <input type="hidden" name="res_id" value="<?php echo $row['restaurant_id'] ?>">
                                            <input type="hidden" name="fd_price" value="<?php echo $row['food_price'] ?>">
                                            <button class="btn btn-lg btn-primary" type="submit" name="add" class="order-btn-res">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                                            <button style="margin-top: 5px;" name="fd_det" type="submit" class="btn btn-lg btn-outline-secondary">Details</button>
                                        </form>
                                    </div>

                                </div>


                            <?php
                            }
                        }
                    }
                    if (isset($_POST['allfood'])) {

                        
                        $query = "SELECT * FROM fooddetail";
                        $result = mysqli_query($conn, $query);
                        $check_result = mysqli_num_rows($result) > 0;

                        if ($check_result) {
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <div class="col-md-6" style="padding:5px;margin-bottom:2rem;">

                                    <div class="col-lg-6">
                                        <img style="width:20rem" src="<?php echo "$row[food_img]" ?>">

                                    </div>
                                    <div class="col-lg-6">
                                        <h2><?php echo $row['food_name']; ?></h2>
                                        <h3><?php echo $row['food_type']; ?></h3>
                                        <h3><?php echo $row['food_price']; ?>/- TK</h3>
                                        <form method="POST">
                                            <input type="hidden" name="food_id" value="<?php echo $row['food_id'] ?>">
                                            <input type="hidden" name="res_id" value="<?php echo $row['restaurant_id'] ?>">
                                            <input type="hidden" name="fd_price" value="<?php echo $row['food_price'] ?>">
                                            <button class="btn btn-lg btn-primary" type="submit" name="add" class="order-btn-res">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                                            <button style="margin-top: 5px;" name="fd_det" type="submit" class="btn btn-lg btn-outline-secondary">Details</button>
                                        </form>
                                    </div>

                                </div>


                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <!--------------- Start of Footer ------------------>

    <footer class="footer">
        <div class="foot1">
            <div class="ft1">
                <a href="#"><img class="ft-logo" src="photos/Food Bee1.png" alt="FOODBEE"></a>
                <br><br><br>
                <h2>Our Delivery Service</h2>
            </div>
            <div class="ft2">
                <h2>About Us</h2><br><br>
                <h5>About us</h5>
                <h5>History</h5>
                <h5>Our Team</h5>
                <h5>We are hiring</h5>
            </div>
            <div class="ft3">
                <h2>How It Works</h2><br>
                <h5>Enter your location</h5>
                <h5>Choose Restaurant</h5>
                <h5>Choose Meal</h5>
                <h5>Choose Payment Method</h5>
                <h5>Wait for delivery</h5>
            </div>
            <div class="ft4">
                <h2>Pages</h2><br>
                <h5>Search result page</h5>
                <h5>User Sign Up Page</h5>
                <h5>Pricing Page</h5>
                <h5>Make Order</h5>
                <h5>Add to Cart</h5>
            </div>
            <div class="ft5">
                <h2>Popular Locations</h2><br>
                <h5>Dhanmondi</h5>
                <h5>Gulshan</h5>
                <h5>Banani</h5>
                <h5>Mirpur</h5>
                <h5>Khilgaon</h5>
            </div>
        </div>
        <div class="foot2">

        </div>
    </footer>

</body>

</html>