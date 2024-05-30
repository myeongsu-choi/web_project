<?php
session_start();

if(isset($_SESSION['logged_email'])) {
    $email_ID = $_SESSION['logged_email'];
}

if(isset($_POST['modify_first_name']) && isset($_POST['modify_last_name']) && isset($_POST['modify_nickname']) 
&& isset($_POST['modify_email']) && isset($_POST['modify_password'])) {
    $modifyFirstName = $_POST['modify_first_name']; 
    $modifyLastName = $_POST['modify_last_name'];
    $modifyNickName = $_POST['modify_nickname'];
    $modifyEmail = $_POST['modify_email'];
    $modifyPass = $_POST['modify_password'];

    $user = 'root';
    $pass = '';
    $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'project') or die(mysqli_error($db));

    $query = "SELECT * FROM member WHERE email != '$email_ID'"; echo $email_ID;
    $result = mysqli_query($db, $query) or die(mysqli_error($db)); 
    while ($row = mysqli_fetch_array($result)) {
        extract($row);
        if($email == $modifyEmail) {
            $_SESSION['message3'] = 1;
            echo "<script>window.location.href = 'modifyProfile.php';</script>";
            exit();
        }
        else if($nickName == $modifyNickName) {
            $_SESSION['message4'] = 1;
            echo "<script>window.location.href = 'modifyProfile.php';</script>";
            exit();   
        }
    }
    $query = "ALTER TABLE comment DROP FOREIGN KEY comment_ibfk_1";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "ALTER TABLE liked DROP FOREIGN KEY liked_ibfk_2";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "UPDATE comment SET email = '$modifyEmail' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "UPDATE liked SET email = '$modifyEmail' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "UPDATE member SET password = '$modifyPass' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "UPDATE member SET nickName = '$modifyNickName' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "UPDATE member SET firstName = '$modifyFirstName' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));  

    $query = "UPDATE member SET lastName = '$modifyLastName' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db)); 
    
    $query = "UPDATE member SET email = '$modifyEmail' WHERE email = '$email_ID'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db)); 

    $query = "ALTER TABLE comment ADD CONSTRAINT comment_ibfk_1 FOREIGN KEY (email) REFERENCES member(email);";
    $result = mysqli_query($db, $query) or die(mysqli_error($db)); 

    $query = "ALTER TABLE liked ADD CONSTRAINT liked_ibfk_2 FOREIGN KEY (email) REFERENCES member(email)";
    $result = mysqli_query($db, $query) or die(mysqli_error($db)); 

    $_SESSION['logged_email'] = $modifyEmail;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="profile.css" rel="stylesheet">
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
                    if((isset($_SESSION['signup']) && $_SESSION['signup'] == 1) || (isset($_SESSION['logged']) && $_SESSION['logged'] == 1)) {
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
                    if((isset($_SESSION['signup']) && $_SESSION['signup'] == 1) || (isset($_SESSION['logged']) && $_SESSION['logged'] == 1)) {
                ?>
                    <a href="profile.php"><img src="images/profile.png" alt="basket"></a>

                <?php } else { ?>
                    <a href="login.php"><img src="images/profile.png" alt="basket"></a>
                <?php } ?>
            </div>
        </div>      
    </header>
    <hr><br><br>

    <h1 style="text-align: center;">Profile</h1>
    <section class="profile2">
        <div class="info">
            <div class="name">
                <?php 
                    if(isset($_SESSION['logged_email'])) { 
                        $user = 'root';
                        $pass = '';

                        $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
                        mysqli_select_db($db, 'project') or die(mysqli_error($db));
                        $query = "SELECT firstName, lastName, nickName
                                FROM member
                                WHERE email = '{$_SESSION['logged_email']}'";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        while($row = mysqli_fetch_array($result)) {
                            extract($row);
                ?>
                <h2 style="color: brown">Name</h2><?php echo '<h1>' . $firstName . ' ' . $lastName . '</h1>'; ?>
                
            </div>
            <div class="nickname">
                <h2 style="color: brown">NickName</h2><?php echo '<h1>' . $nickName . '</h1>'; ?>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
        <div class="alter">
            <div class="update">
                <a href="modifyProfile.php"><h2>Modify Information</h2></a>
            </div>
            <div class="liked">
                <?php if(isset($_SESSION['logged_email'])) {
                     $user = 'root';
                     $pass = '';

                     $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
                     mysqli_select_db($db, 'project') or die(mysqli_error($db));
                     $query = "SELECT count(*) as count
                                FROM liked
                                WHERE email = '{$_SESSION['logged_email']}';";
                     $result = mysqli_query($db, $query) or die(mysqli_error($db));
                     while($row = mysqli_fetch_array($result)) {
                        extract($row);
                ?>
                <a href="wishList.php"><h2>Wish List(<?php echo $count; ?>)</h2></a>
                <?php } ?>
                <?php } ?>
            </div>
            <div class="ordered">
            <?php if(isset($_SESSION['logged_email'])) {
                     $user = 'root';
                     $pass = '';

                     $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
                     mysqli_select_db($db, 'project') or die(mysqli_error($db));
                     $query = "SELECT count(*) as count
                                FROM ordered
                                WHERE email = '{$_SESSION['logged_email']}';";
                     $result = mysqli_query($db, $query) or die(mysqli_error($db));
                     while($row = mysqli_fetch_array($result)) {
                        extract($row);
                ?>
                <a href="ordered.php"><h2>Order history(<?php echo $count; ?>)</h2></a>
                <?php } ?>
                <?php } ?>
            </div>
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
                <li><a href="">Home</a></li>
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