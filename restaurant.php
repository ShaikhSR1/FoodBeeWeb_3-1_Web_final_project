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

    #$query = "SELECT * FROM restaurant WHERE area LIKE '%$_data%'";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>

    <!---------------End of Navbar------------------->


    <!--------------- Start of Search ---------------->


    <section class="search2">
        <div class="search-header2">
            <h1>Search Your Location or Restaurants</h1>
            <h5>Find restaurants specifially</h5>
        </div>
        <div class="search-box2">
            <form class="search-container" action="restaurant.php" method="post">
                <input type="text" id="area2" class="search-txt2" name="search" placeholder="Enter Location..">
                <input type="submit" class="search-btn" value="Go &#8594;">
                <div id="area2-list"></div>

            </form>

        </div>

    </section>

    <!--------------- End of Search ------------------->

    <!----------------Start of Sidebar ---------------------->




    <!------------------ End of Sidebar -------------------->

    <!--------------- Start of Restaurant ------------------>
    <section class="restaurant">
        <center>
            <h1>Popular restaurants in your Area</h1>
        </center>
        <div style="margin-bottom: 2rem;" class="container">
            <div class="card">
                <div class="row" style="padding: 2rem;">

                    <?php
                    if (isset($_POST['search'])) {
                        $data = $_POST['search'];
                        $datas = $data[0] . $data[1] . $data[2];
                        $query = "SELECT * FROM restaurant WHERE area LIKE '$datas%' OR restaurant_name LIKE '%$datas%'";
                        $result = mysqli_query($conn, $query);
                        $check_result = mysqli_num_rows($result) > 0;

                        if ($check_result) {
                            while ($row = mysqli_fetch_array($result)) {

                    ?>
                                <div class="col-md-4" style="padding:5px;margin-bottom:2rem;">
                                    <div class="col-lg-6">
                                        <img style="width:20rem" src="<?php echo $row['restaurant_img'] ?>">

                                    </div>
                                    <div class="col-lg-6">
                                        <h4 style="padding-top:1rem;font-size: 3rem;"><?php echo $row['restaurant_name']; ?></h4>
                                        <h5 style="padding-top:1rem;font-size: 2rem;"><?php echo $row['available_time']; ?></h5>
                                        <form style="padding-top:4rem;" action="foodlist.php" method="POST">
                                            <input type="hidden" name="restaurant_id" value="<?php echo $row['restaurant_id'] ?>">
                                            <button name="subres" type="submit" class="btn btn-lg btn-primary">View Item &#8594</button>
                                        </form>
                                        <?php
                                        if (isset($_POST['subres'])) {
                                            $_SESSION['val'] = 1;
                                        }
                                        ?>
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

    <?php




    ?>



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

<script>
    $(document).ready(function() {
        $('#area2').keyup(function() {
            var quer = $(this).val();
            if (quer.length > 1) {
                $.ajax({
                    url: "search2.php",
                    method: "POST",
                    data: {
                        query: quer
                    },
                    success: function(response) {
                        $('#area2-list').fadeIn();
                        $('#area2-list').html(response);

                    }
                });
            } else {
                $('#area2-list').fadeOut();
                $('#area2-list').html("");
            }
        });
        $(document).on('click', 'li', function() {
            $('#area2').val($(this).text());
            $('#area2-list').fadeOut();
        });
    });
</script>