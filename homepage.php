<?php
session_start();

if(isset($_POST['email']) && isset($_POST['password'])) {

    $_SESSION['useremail'] = $_POST['email'];
    $_SESSION['userpass'] = $_POST['password'];

    $user = 'root';
    $pass = '';

    /*
        An error occurred because it matched the existing MySQL port number, so I changed the port number to 3307 and proceeded with the project.
    */
    $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'project') or die(mysqli_error($db));
    $query = 'SELECT *
            FROM member';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)) {
        extract($row);
        if($_SESSION['useremail'] == $email && $_SESSION['userpass'] == $password) {
            $_SESSION['logged'] = 1;
            $_SESSION['logged_email'] = $_SESSION['useremail'];
            break;
        }
        $_SESSION['logged'] = 0;
    }
    if($_SESSION['logged'] == 0) {
        $_SESSION['message'] = 1;
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
}
?>

<?php
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['sign-email']) && isset($_POST['sign-password']) && isset($_POST['nickname'])) {

    $_SESSION['firstName'] = $_POST['firstname'];
    $_SESSION['lasttName'] = $_POST['lastname'];
    $_SESSION['signEmail'] = $_POST['sign-email'];
    $_SESSION['signPass'] = $_POST['sign-password'];
    $_SESSION['nickname'] = $_POST['nickname'];

    $user = 'root';
    $pass = '';
    $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'project') or die(mysqli_error($db));

    $query = 'SELECT *
            FROM member';
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    while($row = mysqli_fetch_array($result)) {
        extract($row);
        if($_SESSION['signEmail'] == $email || $_SESSION['nickname'] == $nickName) {
            $_SESSION['logged'] = 0;
            break;
        }
        $_SESSION['logged'] = 1;
        $_SESSION['logged_email'] = $_SESSION['signEmail'];
    }
    
    if($_SESSION['logged'] == 1) {
        $query1 = "INSERT INTO member VALUES ('{$_SESSION['signEmail']}', '{$_SESSION['signPass']}', '{$_SESSION['firstName']}', '{$_SESSION['lasttName']}', '{$_SESSION['nickname']}')";
        $result = mysqli_query($db, $query1) or die(mysqli_error($db));
    }

    if($_SESSION['logged'] == 0) {
        $_SESSION['message2'] = 1;
        echo "<script>window.location.href = 'signup.php';</script>";
        exit();
    }
}
?>

<?php
if(isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_unset();
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="header.css" rel="stylesheet"> 
    <link href="first-section.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <script src="first-section.js"></script>
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
        <h3 style="text-align: center; margin-top: 80px;">Best</h3>
        <div class="display">
            <button onclick="previousChange()">&lt;&lt;</button>
            <div class="product-card">
                <a id="link0" href="product.php?id=p01"><img id="productImage0" src="images/KD17.png" alt="product0"></a>
                <p class="name" id="name0">KD17</p>
                <p class="price" id="price0">price : $150</p> 
            </div>
            <div class="product-card">
                <a id="link1" href="product.php?id=p02"><img id="productImage1" src="images/Book 1 'Rattlesnake'.png" alt="product1"></a>
                <p class="name" id="name1">Book 1 "Rattlesnake"</p>
                <p class="price" id="price1">price : $140</p> 
            </div>
            <div class="product-card">
                <a id="link2" href="product.php?id=p03"><img id="productImage2" src="images/Nike Air Max Dn.png" alt="product1"></a>
                <p class="name" id="name2">Nike Air Max Dn</p>
                <p class="price" id="price2">price : $160</p>
            </div>
            <button onclick="nextChange()">&gt;&gt;</button>
        </div>
    </section>
    <section>
        <h3 style="text-align: center; margin-top: 80px;">1+1 packages</h3>
        <div class="display">
            <button onclick="">&lt;&lt;</button>
            <div class="product-card">
                <a href=""><img id="productImage0" src="https://dummyimage.com/400x300/009900/000&text=Product+Image+0" alt="product1"></a>
            </div>
            <div class="product-card">
                <a href=""><img id="productImage1" src="https://dummyimage.com/400x300/009900/000&text=Product+Image+1" alt="product1"></a>
            </div>
            <div class="product-card">
                <a href=""><img id="productImage2" src="https://dummyimage.com/400x300/009900/000&text=Product+Image+2" alt="product1"></a>
            </div>
            <button onclick="">&gt;&gt;</button>
        </div>
    </section>
    <section>
        <h3 style="text-align: center; margin-top: 80px;">New Arrivals</h3>
        <div class="display">
            <button onclick="">&lt;&lt;</button>
            <div class="product-card">
                <a href=""><img id="productImage0" src="https://dummyimage.com/400x300/006600/000&text=Product+Image+0" alt="product1"></a>
            </div>
            <div class="product-card">
                <a href=""><img id="productImage1" src="https://dummyimage.com/400x300/006600/000&text=Product+Image+1" alt="product1"></a>
            </div>
            <div class="product-card">
                <a href=""><img id="productImage2" src="https://dummyimage.com/400x300/006600/000&text=Product+Image+2" alt="product1"></a>
            </div>
            <button onclick="">&gt;&gt;</button>
        </div>
    </section>
    <br>
    <hr>
    <footer>
        <div class="logo">
            <a href="homepage.php"><img src="images/logo.png" alt="Logo Image"></a>
        </div>
        <div class="paragraph">
            <p style="margin-left: 10%; padding: 0 15px;">CUSTOMER SERVICE <br> MON-FRI 10:00 - 17:00 // LUNCH 12:00-13:00 SAT.SUN.HOLIDAY OFF</p>
        </div>
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