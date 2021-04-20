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



    <!---------------End of Navbar------------------>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foodbee";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } #else echo "Connected successful";



    #$countResult = mysqli_fetch_assoc($count);




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
                <li><a href="#addloc">Locations</a></li>
                <!--<li><a>Reports</a></li>
                <li><a>Users</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a>Users</a></li>-->

            </ul>
        </div>
    </section>



    <section class="dashboard" id="dashboard">


        <div class="cont">
            <div class="cont-header">
                <h2>Dashboard</h2>
            </div>
            <div class="admin_row">
                <div class="dsbd-col" onclick=" location.href='restadmin.php' ;" style="cursor: pointer;">
                    <h4>Total Restaurant</h4>
                    <br>
                    <h5><?php
                        $sql2 = "SELECT * from restaurant";
                        $query_r = mysqli_query($conn, $sql2);
                        $count = mysqli_num_rows($query_r);
                        echo $count;
                        ?></h5>
                </div>
                <div class="dsbd-col" onclick="location.href='riders.php';" style="cursor: pointer;">
                    <h4>Total Riders</h4>
                    <br>
                    <h5><?php
                        $sql3 = "SELECT * from riders";
                        $query_r = mysqli_query($conn, $sql3);
                        $count = mysqli_num_rows($query_r);
                        echo $count; ?>
                    </h5>
                </div>

            </div>

            <!--
            <div class="row">
                <div class="col-md-4 dsbd-col">Panding Orders</div>
                <div class="col-md-4 dsbd-col">Deliverd Today</div>
                <div class="col-md-4 dsbd-col">Riders</div>
            </div>

            <div class="row">
                <div class="col-md-6 dsbd-col">This Month's Revenue</div>
                <div class="col-md-6 dsbd-col">Order Overview</div>
            </div> -->
        </div>


    </section>

    <section class="orders" id="ordr">
        <div class="cont">
            <div class="ord-header">
                <h2>Order</h2>
            </div>
            <div class="admin_row2">
                <div class="dsbd-col2" onclick="location.href='orders.php';" style="cursor: pointer;">
                    <h4>Confirmed</h4>
                    <br>
                    <h5><?php
                        $sql2 = "SELECT * FROM `orders` WHERE `status`='3' ";
                        $query_r = mysqli_query($conn, $sql2);
                        $count = mysqli_num_rows($query_r);
                        echo $count;
                        ?>
                    </h5>
                </div>
                <div class="dsbd-col33" onclick=" location.href='orders.php' ;" style="cursor: pointer;">
                    <h4>Unconfirmed</h4>
                    <br>
                    <h5><?php
                        $sql2 = "SELECT * FROM `orders` WHERE `status`='2' ";
                        $query_r = mysqli_query($conn, $sql2);
                        $count = mysqli_num_rows($query_r);
                        echo $count;
                        ?></h5>
                </div>

                <div class="dsbd-col4" onclick=" location.href='orders.php' ;" style="cursor: pointer;">
                    <h4>Delivered</h4>
                    <br>
                    <h5><?php
                        $sql2 = "SELECT * FROM `orders` WHERE `status`='4' ";
                        $query_r = mysqli_query($conn, $sql2);
                        $count = mysqli_num_rows($query_r);
                        echo $count;
                        ?>
                    </h5>
                </div>

            </div>

        </div>
    </section>


    <?php
    if (isset($_POST['add_loc'])) {
        $var1 = $_POST['loc_code'];
        $var2 = $_POST['location'];
        $var3 = $_POST['area'];

        $sql = "INSERT INTO `location` (`loc_code`, `location`, `area`) VALUES ('$var1', '$var2', '$var3')";
    }


    ?>


    <section class="add_location">
        <div class="cont">
            <div class="cont-header">
                <h2>Add Locations</h2>
            </div>
        </div>
        <br><br>
        <div class="container" id="addloc">
            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card">
                        <div class="card card-6">

                            <form style="padding: 20px;" " method=" POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="loc_code" name="loc_code" placeholder="Location Code">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="area" name="area" placeholder="Area">
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit" name="add_loc">Add Location</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("addloc").reset();
    </script>


</body>

</html>



<!--$sql = "INSERT INTO restaurant (restaurant_id, restaurant_name, area, manager_contact, available_time, restaurant_img) 
            VALUES ('".$res_id."','".$res_nm."','".$res_loc."','".$mng_inf."','".$avl_tm."','".$fileDestination."')";-->