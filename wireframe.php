<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="wireframe_header.css" rel="stylesheet">
    <link href="wireframe_section.css" rel="stylesheet">
    <link href="wireframe_footer.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <a href="homepage.php"><img src="" alt="Logo Image"></a>
        </div>
        <nav class="header-navigation">
            <ul>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
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
    <section>
        <div class="display">
            <button onclick="previousChange()">Previous</button>
            <div class="product-card">
                <a href=""><img id="productImage0" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+0" alt="product1"></a>
            </div>
            <div class="product-card">
                <a href=""><img id="productImage1" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+1" alt="product1"></a>
            </div>
            <div class="product-card">
                <a href=""><img id="productImage2" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+2" alt="product1"></a>
            </div>
            <button onclick="nextChange()">Next</button>
        </div>
    </section>
    <section>
        <h3 style="text-align: center; margin-top: 80px;">1+1 packages</h3>
        <div class="package">
            <button onclick="">Previous</button>
            <div class="package-card">
                <a href=""><img id="" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+0" alt="product1"></a>
            </div>
            <div class="package-card">
                <a href=""><img id="" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+1" alt="product1"></a>
            </div>
            <div class="package-card">
                <a href=""><img id="" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+2" alt="product1"></a>
            </div>
            <button onclick="">Next</button>
        </div>
    </section>
    <section>
        <h3 style="text-align: center; margin-top: 80px;">New Arrivals</h3>
        <div class="package">
            <button onclick="">Previous</button>
            <div class="package-card">
                <a href=""><img id="" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+0" alt="product1"></a>
            </div>
            <div class="package-card">
                <a href=""><img id="" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+1" alt="product1"></a>
            </div>
            <div class="package-card">
                <a href=""><img id="" src="https://dummyimage.com/300x300/FFFFFF/000&text=Product+Image+2" alt="product1"></a>
            </div>
            <button onclick="">Next</button>
        </div>
    </section>
    <footer>
        <div class="logo">
            <a href="homepage.php"><img src="" alt="Logo Image"></a>
        </div>
        <p style="margin-left: 10%; padding: 0 15px;">CUSTOMER SERVICE <br> MON-FRI 10:00 - 17:00 // LUNCH 12:00-13:00 SAT.SUN.HOLIDAY OFF</p>
        <nav class="footer-navigation">
            <ul>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
                <a href=""><li>Menu</li></a>
            </ul>
        </nav>
    </footer>
</body>
</html>