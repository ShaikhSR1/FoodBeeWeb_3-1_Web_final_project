<?php
session_start();
error_reporting(0);

?>


<section class="container1">
    <div class="navbar" style="height: 50px; ">
        <div class="nav-logo">
            <a href="#">
                <img src="./photos/Food Bee1.png" width="125px" alt="FOODBEE">
            </a>
        </div>
        <nav>
            <ul class="main-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="restaurant.php">Restaurants</a></li>
                <li><a href="foodlist.php">Foods</a></li>
                <!--<li><a href="./Contact Page/contact.html">Contact</a></li>-->
                <li><a href="account.php">
                        <?php
                        if ($_SESSION['c_userid']) {
                            echo $_SESSION['c_userid'];
                        } else echo "<span>Login</span>";
                        ?>
                    </a></li>
                <li><a href="cart.php">Cart <i class="fas fa-shopping-cart"></i></a></li>
                <!--<li style="color:black;text-align:center;padding: 0 0.9rem 0.1rem 0.8rem;background-color:white;border-radius: 3rem;">
                    <?php
                    //error_reporting(E_ERROR | E_WARNING | E_PARSE);
                    if (count($_SESSION['cart'])) {
                        $count = count($_SESSION['cart']);
                        echo "<span>$count</span>";
                    } else {
                        echo "<span>0</span>";
                    }
                    ?>
                </li>-->
            </ul>
        </nav>

    </div>
</section>