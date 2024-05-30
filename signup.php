<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="signupPage.css" rel="stylesheet">
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
                    if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
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
    <hr>
    <section class="signup-section">
        <form method="post" action="homepage.php">
            <h2 style="font-size: 50px; text-align: center;">SignUp</h2>
            <br>
            <fieldset>
                <div>
                    <label for="first_name">First name:</label><br>
                    <input type="text" name="firstname" id="first_name" placeholder="Enter your First name" required>
                </div>
                <div>
                    <label for="last_name">Last name:</label><br>
                    <input type="text" name="lastname" id="last_name" placeholder="Enter your Second name" required>
                </div>
                <div>
                    <label for="nickname">Nickname:</label><br>
                    <input type="text" name="nickname" id="nickname" placeholder="Enter your Nickname" required>
                </div>
                <div>
                    <label for="sign-email">Email:</label><br>
                    <input type="email" name="sign-email" id="email" placeholder="Enter your Email" required> <br>
                </div>
                <div>
                    <label for="sign-password">Password:</label><br>
                    <input type="password" name="sign-password" id="password" placeholder="Enter your Password" required>
                </div>
                <button type="submit">Submit</button>
                <?php if(isset($_SESSION['message2']) && $_SESSION['message2'] == 1) { ?>
                    <p style="color : red">Subscribed email exists, please sign up with another email.</p>
                <?php } $_SESSION['message2'] = 0; ?>
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
