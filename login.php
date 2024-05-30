<?php 
    session_start()
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="loginPage.css" rel="stylesheet">
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
                <a href="login.php">LOGIN</a>
            </div>
            <div class="signup">
                <a href="signup.php">SINGUP</a>
            </div>
            <div class="profile">
                <a href="login.php"><img src="images/profile.png" alt="basket"></a>
            </div>
        </div>       
    </header>
    <hr>
    <section class="login-section">
        <form method="post" action="homepage.php">
            <h2 style="font-size: 50px">Login</h2>
            <fieldset>
                <div>
                    <input type="email" name="email" placeholder="Enter your EMAIL" required> <br>
                </div>
                <div>
                    <input type="password" name="password" placeholder="Enter your PASSWORD" required>
                </div>
                <div>
                    <button type="submit">Submit</button>
                </div>
                <?php if(isset($_SESSION['message']) && $_SESSION['message'] == 1) { ?>
                    <p style="color : red">Your email and password do not match. Please try again.</p>
                <?php } $_SESSION['message'] = 0;?>
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