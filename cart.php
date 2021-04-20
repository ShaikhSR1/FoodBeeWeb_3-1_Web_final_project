<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Foodies Hub</title>
    <link rel="icon" href="photos\icon1.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css\bootstrap.css">
    <link rel="stylesheet" href="css\style.css">
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
    } else echo "Connected successfully";

    $var_uid = $_SESSION['c_userid'];
    $fee = 25;
    $total = 0;
    ?>

    <br>
    <br>
    <section>
        <div class="container-fluid">
            <br>
            <br>
            <h1 style="text-align:center;">My Cart</h1>
            <div class="row px-5">
                <div class="col-md-7">

                    <hr>

                    <?php

                    $query = "SELECT * FROM orders WHERE userid='$var_uid' AND `status`='1'";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result)) {
                        $var_fid = $row['food_id'];
                        $sql = "SELECT * FROM fooddetail WHERE food_id='$var_fid'";
                        $query2 = mysqli_query($conn, $sql);
                        while ($row2 = mysqli_fetch_array($query2)) {
                            $total = $total +  (int)$row['price'];
                    ?>
                            <form method="post" class="cart-items">
                                <div class="border rounded">
                                    <div class="row bg-white">
                                        <div class="col-md-4">
                                            <img style="width: 280px;overflow: hidden;" src="./<?php echo "$row2[food_img]" ?>" alt="" class="">
                                        </div>
                                        <div style="padding-left:5rem;" class="col-md-4">
                                            <h1 class="pt-2"><?php echo $row2['food_name']; ?></h1>
                                            <h4 style="text-align:left;" class="text-secondary"><?php echo $row2['food_type']; ?></h4>
                                            <h3 class="pt-2"><?php echo $row2['food_price']; ?>/- TK</h3>
                                            <br>
                                            <!--<button type="submit" class="btn-lg btn-warning">Save for latter </button>-->
                                            <input type="hidden" name="foodid" value="<?php echo $row['food_id'] ?>">
                                            <button style="font-size:large;width: 100px; height:40px;" type="submit" name="remove" class="btn btn-danger">Remove</button>
                                        </div>
                                        <div class="col-md-4 ">
                                            <br>
                                            <h3>Delivery Amount: <?php echo $row['amount'] ?></h3>
                                            <form method="POST">
                                                <input placeholder="Enter Amount" style="margin: 8px 0; padding:8px 10px; box-sizing: border-box ;border: 2px solid black;" type="text" name="amount">
                                                <input type="hidden" name="foodid" value="<?php echo $row['food_id'] ?>">
                                                <input type="hidden" name="foodpr" value="<?php echo $row2['food_price'] ?>">
                                                <button type="submit" name="update" class="btn btn-lg btn-primary">Update</button>

                                            </form>
                                            <h3>Amount payable: <?php echo $row['price'] ?></h3>
                                        </div>

                                    </div>
                                </div>
                            </form>
                            <br><br>
                    <?php
                        }
                    }


                    if (isset($_POST['remove'])) {
                        $fdid = $_POST['foodid'];
                        $sql = "DELETE FROM `orders` WHERE `food_id`='$fdid' AND `userid`='$var_uid' AND `status`='1'";
                        $query = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($query);

                        echo ("<meta http-equiv='refresh' content='1'>");
                        header("Refresh:1");
                    }

                    ?>
                </div>

                <?php

                if (isset($_POST['update'])) {

                    $temp2 = $_POST['foodid'];
                    $temp3 = $_POST['amount'];
                    $temp4 = $_POST['foodpr'];
                    $temp5 = ((int)$temp4) * ((int)$temp3);
                    $sql = "UPDATE `orders` SET `amount`='$temp3', `price`='$temp5'  WHERE `userid`='$var_uid' AND `food_id`='$temp2' AND `status`='1'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);

                    echo ("<meta http-equiv='refresh' content='1'>");
                    header("Refresh:1");
                }
                ?>



                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                    <div class="pt-4">
                        <h2>Price Details</h2>
                        <hr>
                        <div class="row price-details">
                            <div class="col-md-6">
                                <h3>Price </h3>
                                <h3>Delivery Charges</h3>
                                <hr>
                                <h3>Amount Payable</h3>
                            </div>
                            <div class="col-md-6">
                                <h3><?php echo $total; ?>/- TK</h3>
                                <h4 class="text-success"><?php echo $fee; ?>/- TK</h4>
                                <hr>
                                <h3><?php echo $total + $fee; ?>/- TK</h3>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST">
                                    <h3><label for="location">Enter Location</label></h3>
                                    <input type="text" name="location" placeholder="Enter Location" style="margin: 8px 0; padding:8px 10px; box-sizing: border-box ;border: 2px solid black;">
                                    <button name="conf" type="submit" style="font-size: large;" class="btn btn-lg btn-primary">Confirm</button>
                                </form>
                                <br>
                                <br>
                                <a href="profile.php"><button style="font-size:large;margin-bottom: 10px;" type="button" class="btn btn-lg btn-success">Check Your Orders</button></a>

                            </div>
                        </div>

                        <?php

                        if (isset($_POST['conf'])) {
                        
                            $loc = $_POST['location'];
                            $sql = "SELECT * FROM `orders`";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $sql2 = "UPDATE `orders` SET `location`='$loc', `status`='2' WHERE `userid`='$var_uid' AND `status`='1'";
                                $res2 = mysqli_query($conn, $sql2);
                            }
                            echo ("<meta http-equiv='refresh' content='1'>");
                            header("Refresh:1");
                        
                        }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>