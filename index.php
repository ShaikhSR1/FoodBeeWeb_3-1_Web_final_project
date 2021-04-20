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
    #echo "Connected successfully";


    ?>

    <!------------------------------------------------------------------>

    <?php

    require_once("./header.php")
    ?>
    <section class="header">
        <div class="row2">
            <div class="hero-text">
                <h1>Food Bee</h1>
                <h4>- the hive of good food</h4>
            </div>
        </div>
        <div class="search-box">
            <form class="search-container" action="restaurant.php" method="post">
                <input type="text" id="area" class="search-txt" name="search" placeholder="Enter Your Location..">

                <input type="submit" class="search-btn" value="Go &#8594;">
                <div id="area-list"></div>
            </form>
        </div>

    </section>

    <!-- End of header section-->
    <br><br><br>
    <hr>

    <?php
    $sql = "SELECT * FROM `homemade`;";
    $result = mysqli_query($conn, $sql);

    ?>

    <!--<section class="home1">
        <h2>Try our special items</h2>
        <h4>The easiest way to your favourite food</h4>
       <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card" style="max-width: 1200px;margin: auto;">
                <div class="row-fluid" style="padding: 2rem;">
                    <div class="card-group ">
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <div class="col-md-4" style="margin-bottom:2rem;">
                                    <div class="card w-100 h-100">
                                        <img class="card-img-top" src="<?php echo $row['food_img'] ?>" alt="Card image cap">
                                        <div class="card-body">
                                            <h3 class="card-title"><?php echo $row['food_name'] ?></h3>
                                            <h4 class="card-title"><?php echo $row['food_type'] ?></h4>
                                            <p class="card-title"><?php echo $row['food_cuisine'] ?></p>
                                            <p class="card-text">Unit Price: <?php echo $row['food_price'] ?></p>
                                        </div>
                                        <!--<div class="card-footer">
                                <small class="text-muted">Last updated 3 mins ago</small>
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

        <div class="row1">
                <div class="hm-col-3">
                    <img src="./photos/rest/res10.jpg">
                    <h3>Home Baked Pasta</h3>
                    <h4>Pasta</h4>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fas fa-star-half-alt"></i>
                    <h3>250/- TK </h3>
                    <button class="order-btn">Add To Cart</button>
                </div>
                <div class="hm-col-3">
                    <img src="./photos/rest/res5.jpg">
                    <h3>Special Lunch Pack</h3>
                    <h4>Lunch</h4>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fas fa-star-half-alt"></i>
                    <h3>300/- TK</h3>
                    <button class="order-btn">Add To Cart</button>
                </div>
                <div class="hm-col-3">
                    <img src="./photos/rest/res3.jpg">
                    <h3>Chicken Bowl</h3>
                    <h4>Chicken</h4>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fa fa-star"></i>
                    <i class="hm-star-icon fas fa-star-half-alt"></i>
                    <h3>140/- TK</h3>
                    <button class="order-btn">Add To Cart</button>
                </div>
            </div>
    </section>-->

    <section class="home2">
        <div class="ostep">
            <img src="photos/bg2.png">
        </div>
    </section>

    <section class="home4">
        <div class="ostep">
            <img src="photos/bg3.png">
        </div>
    </section>

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
<script>
    $(document).ready(function() {
        $('#area').keyup(function() {
            var query = $(this).val();
            if (query.length > 1) {
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#area-list').fadeIn();
                        $('#area-list').html(data);

                    }
                });
            } else {
                $('#area-list').fadeOut();
                $('#area-list').html("");
            }
        });
        $(document).on('click', 'li', function() {
            $('#area').val($(this).text());
            $('#area-list').fadeOut();
        });
    });
</script>