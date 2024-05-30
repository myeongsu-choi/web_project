<?php 
    session_start();
    if(isset($_SESSION['logged_email'])) {
        $emailID = $_SESSION['logged_email'];
    }

    $user = 'root';
    $pass = '';

    $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'project') or die(mysqli_error($db));
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Profile</title>
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="modifyProfile.css" rel="stylesheet">
    <style>
        
        
    </style>
</head>
<body>
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
    <br>
    <section class="modify-section">
        <?php 
            $query = "SELECT *
                      FROM member
                      WHERE email = '$emailID'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            while($row = mysqli_fetch_array($result)) {
                extract($row);
                $firstname = $firstName;
                $lastname = $lastName;
                $pass = $password;
                $nick = $nickName;
            }
        ?>
        
        <form method="post" action="profile.php">
            <h2 style="font-size: 50px; text-align: center;">Modify Information</h2>
            <br>
            <fieldset>
                <div>
                    <label for="modify_first_name">First name:</label><br>
                    <input type="text" name="modify_first_name" id="first_name" value="<?php echo $firstname; ?>" required>
                </div>
                <div>
                    <label for="modify_last_name">Last name:</label><br>
                    <input type="text" name="modify_last_name" id="last_name" value="<?php echo $lastname; ?>" required>
                </div>
                <div>
                    <label for="modify_nickname">Nickname:</label><br>
                    <input type="text" name="modify_nickname" id="nickname" value="<?php echo $nick; ?>" required>
                </div>
                <div>
                    <label for="modify_email">Email:</label><br>
                    <input type="email" name="modify_email" id="email" value="<?php echo $emailID; ?>" required> <br>
                </div>
                <div>
                    <label for="modify_password">Password:</label><br>
                    <input type="password" name="modify_password" id="password" value="<?php echo $pass; ?>" required>
                </div>
                <button type="submit">Submit</button>
                <?php if(isset($_SESSION['message3']) && $_SESSION['message3'] == 1) { ?>
                    <p style="color : red">Subscribed email exists, please sign up with another email.</p>
                <?php } $_SESSION['message3'] = 0; ?>
                <?php if(isset($_SESSION['message4']) && $_SESSION['message4'] == 1) { ?>
                    <p style="color : red">Subscribed nickname exists, please sign up with another nickname.</p>
                <?php } $_SESSION['message4'] = 0; ?>
            </fieldset>
        </form>
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