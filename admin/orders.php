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
                <!--<li><a>Locations</a></li>
                <li><a>Reports</a></li>
                <li><a>Users</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a>Users</a></li>-->

            </ul>
        </div>
    </section>


    <?php
    if (isset($_POST['od_con'])) {
        $var1 = $_POST['dtluser_id'];
        $var2 = $_POST['dtlfood_id'];
        $sql = "UPDATE `orders` SET `status`='3' WHERE `userid`='$var1' AND `food_id`='$var2' AND `status`='2'";
        $result = mysqli_query($conn, $sql);
        echo ("<meta http-equiv='refresh' content='1'>");
        header("Refresh:1");
    }

    ?>




    <section class="order_list" id="order_list">
        <button style="margin-top: 10px; margin-left: 10px" class="btn btn-primary" type="button" onclick="myFunction()">Confirmed</button>
        <button style="margin-top: 10px; margin-left: 10px" class="btn btn-warning" type="button" onclick="myFunction2()">Unconfirmed</button>
        <button style="margin-top: 10px; margin-left: 10px" class="btn btn-success" type="button" onclick="myFunction3()">Delivered</button>

        <div class="container" id="confirmed" style="margin-top:10px;display:none;">
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
                                                        <h4 style="text-align:center;width:200px;height:32px;border-radius:5px;margin: 10px; color:white; background: #007bff">Confirmed Order List</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM orders WHERE `status`='3'";
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
                                                                            <p><?php echo $row['userid']; ?></p>
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
                                                                                <input type="hidden" name="dtlfood_id" value="<?php echo $row['food_id'] ?>">
                                                                                <input type="hidden" name="dtluser_id" value="<?php echo $row['userid'] ?>">
                                                                                <!--<button name="od_det" type="submit" class="btn btn-sm btn-outline-secondary">Details</button>-->
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

        <div class="container" id="unconfirmed" style="margin-top:10px;display:none;">
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
                                                        <h4 style="text-align:center;width:280px;height:32px;border-radius:5px;margin: 10px; color:white; background: #ffc107">Unconfirmed Order List</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM orders WHERE `status`='2'";
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
                                                                            <p><?php echo $row['userid']; ?></p>
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
                                                                                <input type="hidden" name="dtlfood_id" value="<?php echo $row['food_id'] ?>">
                                                                                <input type="hidden" name="dtluser_id" value="<?php echo $row['userid'] ?>">
                                                                                <button name="od_con" type="submit" class="btn btn-sm btn-outline-primary">Confirm</button>
                                                                                <button name="od_det" type="submit" class="btn btn-sm btn-outline-secondary">Details</button>
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

        <div class="container" id="delivered" style="margin-top:10px;display:none;">
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
                                                        <h4 style="text-align:center;width:200px;height:32px;border-radius:5px;margin: 10px; color:white; background: #28a745">Delivered Order List</h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM orders WHERE `status`='4'";
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
                                                                            <p><?php echo $row['userid']; ?></p>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="widget-26-job-info">
                                                                            <p class="type m-0"><?php echo $row2['food_name'];  ?></p>
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
                                                                                <input type="hidden" name="dtlfood_id" value="<?php echo $row['food_id'] ?>">
                                                                                <input type="hidden" name="dtluser_id" value="<?php echo $row['userid'] ?>">
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
            var x = document.getElementById("confirmed");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction2() {
            var x = document.getElementById("unconfirmed");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function myFunction3() {
            var x = document.getElementById("delivered");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

</body>

</html>