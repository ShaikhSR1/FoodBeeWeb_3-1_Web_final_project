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

    if (isset($_POST['add_rd'])) {
        $file = $_FILES['file'];
        #print_r($file);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $rd_id = $_POST['rider_id'];
        $rd_nm = $_POST['rider_nm'];
        $rd_phn = $_POST['rider_phn'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 90000000) {
                    $fileDestination = 'uploads/' . $fileName;
                    move_uploaded_file($fileTmpName, '../' . $fileDestination);
                    header("Location: riders.php?uploadsuccess");
                } else {
                    echo "File size too big";
                }
            } else {
                echo "There was an error uploading your file";
            }
        } else {
            echo "You can not upload files of this type";
        }

        $sql = "INSERT INTO riders (rd_id, rd_name, rd_phone, rd_image) 
            VALUES ('$rd_id','$rd_nm','$rd_phn','$fileDestination')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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

    <section class="add_rider">
        <div class="cont">
            <div class="cont-header">
                <h2>Riders</h2>
            </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="myFunction()" style="margin-left: 20px; margin-top:20px; margin-bottom: 20px;">Add Rider</button>
        <div class="container" id="add_rd">
            <div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card">
                        <div class="card card-6">

                            <form style="padding: 20px;" action="riders.php" class="rd-enter" method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="rd_id" name="rider_id" placeholder="Rider ID">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="rd_nm" name="rider_nm" placeholder="Rider Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control" id="rd-phn" name="rider_phn" placeholder="Rider Phone">
                                    </div>
                                </div>

                                <div class="custom-file">
                                    <input type="file" name="file" id="file"><br>
                                </div>
                                <button class="btn btn-success" type="submit" name="add_rd">Add Rider</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="restaurant_list" id="restaurant_list">
        <div class="container">
            <!--<div class="row">
                <div class="col-lg-12 card-margin">
                    <div class="card search-form">
                        <div class="card-body p-0">
                            <form id="search-form">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row no-gutters">
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Mirpur</option>
                                                    <option>Uttara</option>
                                                    <option>Dhanmondi</option>
                                                    <option>Mohammadpur</option>
                                                    <option>Shyamoli</option>
                                                    <option>Badda</option>
                                                    <option>Bashundhara</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12 p-0">
                                                <input type="text" placeholder="Search..." class="form-control" id="search" name="search">
                                            </div>
                                            <div class="col-lg-1 col-md-3 col-sm-12 p-0">
                                                <button type="submit" class="btn btn-base">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>-->
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
                                                        <h4>Riders List</h4>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <!--<div class="result-actions">
                                                        <div class="result-sorting">
                                                            <span>Sort By:</span>
                                                            <select class="form-control border-0" id="exampleOption">
                                                                <option value="1">Relevance</option>
                                                                <option value="2">Names (A-Z)</option>
                                                                <option value="3">Names (Z-A)</option>
                                                            </select>
                                                        </div>
                                                        <div class="result-views">
                                                            <button type="button" class="btn btn-soft-base btn-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                                                    <line x1="3" y1="6" x2="3" y2="6"></line>
                                                                    <line x1="3" y1="12" x2="3" y2="12"></line>
                                                                    <line x1="3" y1="18" x2="3" y2="18"></line>
                                                                </svg>
                                                            </button>
                                                            <button type="button" class="btn btn-soft-base btn-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                                                    <rect x="3" y="3" width="7" height="7"></rect>
                                                                    <rect x="14" y="3" width="7" height="7"></rect>
                                                                    <rect x="14" y="14" width="7" height="7"></rect>
                                                                    <rect x="3" y="14" width="7" height="7"></rect>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-body">
                                            <div class="table-responsive">

                                                <table class="table widget-26">
                                                    <tbody>
                                                        <?php

                                                        $query = "SELECT * FROM riders";
                                                        $result = mysqli_query($conn, $query);

                                                        while ($rdrow = mysqli_fetch_array($result)) {
                                                        ?>

                                                            <tr>
                                                                <td>
                                                                    <div class="widget-26-job-emp-img">
                                                                        <img src="../<?php echo $rdrow['rd_image'] ?>" alt="Company" />
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-title">
                                                                        <h6><?php echo $rdrow['rd_name']; ?></h6>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-info">
                                                                        <p class="type m-0"><?php echo $rdrow['rd_phone']; ?></p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-salary"><?php echo $rdrow['rd_id']; ?></div>
                                                                </td>
                                                                <!--<td>
                                                                    <div class="widget-26-job-category ">
                                                                        <form action="restdetails.php" method="POST">
                                                                            <input type="hidden" name="dtlrest_id" value="<?php echo $row['restaurant_id'] ?>">
                                                                            <button name="res_details" type="submit" class="btn btn-sm btn-outline-secondary">Menu and More</button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="widget-26-job-starred">
                                                                        <a href="#">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star">
                                                                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </td>-->
                                                            </tr>
                                                        <?php
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
            var x = document.getElementById("add_rd");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>


</body>

</html>