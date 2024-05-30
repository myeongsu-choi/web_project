<?php
    session_start();

    if(isset($_SESSION['storeID'])) {
        $ID = $_SESSION['storeID'];
    }

    if(isset($_SESSION['logged_email'])) {
        $email = $_SESSION['logged_email'];
    }

    if(isset($_POST['quantity']) && isset($_POST['address']) && isset($_POST['date'])) {
        $quantity_ = $_POST['quantity'];
        $address_ = $_POST['address'];
        $date_ = $_POST['date'];

        $user = 'root';
        $pass = '';
        $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
        mysqli_select_db($db, 'project') or die(mysqli_error($db));
        $query = "INSERT INTO ordered(email, productID, quantity, deliveryAddress, orderDate) VALUES ('$email', '$ID', '$quantity_', '$address_', '$date_')";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        header("Location: ordered.php");
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordered</title>
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="ordered.css" rel="stylesheet">
</head>
<body>
<header>
        <div class="logo">
            <a href="homepage.php"><img src="images/logo.png" alt="Logo Image"></a>
        </div>
        <nav class="header-navigation">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">Shop</a>
                    <div class="dropdown-content">
                        <a href="#">Male</a>
                        <a href="#">Female</a>
                        <a href="#">Child</a>
                    </div>
                </li>
                </div>
                <li><a href="">1+1</a></li>
                <li><a href="">New</a></li>
                <li><a href="">Community</a></li>
            </ul>
        </nav>
        <div class="search-login-singup-profile">
            <div class="search">
                <a href="search.php"><img src="images/search-icon.avif" alt="SEARCH"></a>
            </div>
            <div class="login">
                <?php
                    if((isset($_SESSION['logged']) && $_SESSION['logged'] == 1)) {
                ?>
                <a href="homepage.php?logout=1">LOGOUT</a>
                <?php } else { ?>
                <a href="login.php">LOGIN</a>
                <?php } ?>
            </div>
            <div class="signup">
                <a href="signup.php">SINGUP</a>
            </div>
            <div class="profile">
                <?php
                    if((isset($_SESSION['logged']) && $_SESSION['logged'] == 1)) {
                ?>
                    <a href="profile.php"><img src="images/profile.png" alt="basket"></a>

                <?php } else { ?>
                    <a href="login.php"><img src="images/profile.png" alt="basket"></a>
                <?php } ?>
            </div>
        </div>      
    </header>
    <hr>
    
    <section>
        <div class="container">
            <?php 
                $user = 'root';
                $pass = '';
                $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
                mysqli_select_db($db, 'project') or die(mysqli_error($db));
                $query = "SELECT productID, quantity, deliveryAddress, orderDate FROM ordered WHERE email = '$email'"; 
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                while($row = mysqli_fetch_array($result)) {
                    extract($row);
                    $query2 = "SELECT productName, price FROM product WHERE productID = '$productID'"; 
                    $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
                    while($row2 = mysqli_fetch_array($result2)) {
                        extract($row2); ?>
            
            <div class="orderd">
                <div class="image">
                    <a href="product.php?id=<?php echo $productID ?>"><img src="images/<?php echo $productName; ?>.png"></a>
                </div>
                <div class="descript">
                    <h1 style="color: brown;"><?php echo $productName; ?></h1>
                    <h2 style="color: brown;">Price :<?php echo $price; ?></h2>
                </div>
            </div>
            <div class="details">
                <h3>Quantity : <?php echo $quantity; ?></h3>
                <h3>Delivery Address : <?php echo $deliveryAddress; ?></h3>
                <h3>Order date : <?php echo $orderDate; ?></h3>
            </div>
            <hr><br>

            <?php
                    }
                }
            ?>
        </div>
    </section>

    <br>
    <hr>
    <footer>
        <div class="logo">
            <a href="homepage.php"><img src="images/logo.png" alt="Logo Image"></a>
        </div>
        <p style="margin-left: 10%; padding: 0 15px;">CUSTOMER SERVICE <br> MON-FRI 10:00 - 17:00 // LUNCH 12:00-13:00 SAT.SUN.HOLIDAY OFF</p>
        <nav class="footer-navigation">
            <ul>
                <li><a href="homepage.php">Home</a></li>
                <li><a href="#">Shop</a>
                    <div class="dropdown-content2">
                        <a href="#">Male</a>
                        <a href="#">Female</a>
                        <a href="#">Child</a>
                    </div>
                </li>
                </div>
                <li><a href="">1+1</a></li>
                <li><a href="">New</a></li>
                <li><a href="">Community</a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>