<?php 
    session_start(); 
    $tmp = 0;
    if(isset($_GET['id'])) {
        $product_ID = $_GET['id'];
        $_SESSION['storeID'] = $product_ID;
    }
    if(isset($_SESSION['logged_email'])) {
        $emailID = $_SESSION['logged_email'];
    }

    if(isset($_POST['comment'])) {
        $postComment = $_POST['comment'];
        if(isset($_SESSION['logged_email'])) {
            $logged_email = $_SESSION['logged_email'];
            
            $user = 'root';
            $pass = '';
            $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
            mysqli_select_db($db, 'project') or die(mysqli_error($db));

            $postCommentEscaped = mysqli_real_escape_string($db, $postComment);
            $query = "INSERT into comment(comment, email, productID)
                      VALUES ('$postCommentEscaped', '$logged_email', '$product_ID')";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            echo '<meta http-equiv="refresh" content="0">';
            exit();
        }
        else {
        ?>
        <script> window.alert("Please log in"); </script>
<?php
        }
    }
?>

<?php
    if(isset($_GET['heart']) && isset($_SESSION['logged_email'])) {
        $user = 'root';
        $pass = '';
        $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
        mysqli_select_db($db, 'project') or die(mysqli_error($db));

        if($_GET['heart'] == 0) {
            $query = "DELETE FROM liked WHERE productID = '$product_ID'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
        }
        else if($_GET['heart'] == 1) {
            $query = "INSERT INTO liked(productID, email) VALUES ('$product_ID', '$emailID')";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
        }
    }

    if(!isset($_SESSION['logged_email']) && isset($_GET['heart'])) {
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="header.css" rel="stylesheet">
    <link href="footer.css" rel="stylesheet">
    <link href="product.css" rel="stylesheet">
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
         <?php 
            if(isset($_GET['id'])) { 

                $user = 'root';
                $pass = '';

            $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
            mysqli_select_db($db, 'project') or die(mysqli_error($db));

            $query = "SELECT productName, price
                    FROM product
                    WHERE productID = '$product_ID'";
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            while($row = mysqli_fetch_array($result)) {
                extract($row);?> 
        <div class="image">
            <img src="images/<?php echo $productName; ?>.png" alt="Image"> 
        </div>
        <h2 style="font-weight: bold; text-align: center; color: brown;"><?php echo $productName ?></h2>
        <p style="font-weight: bold; text-align: center; color: brown;"><?php echo $price ?></p>
        <br><br>
        <?php } ?>

        <?php 
            $query = "SELECT title, content
                        FROM description
                        WHERE productID = '$product_ID'"; 
            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            while($row = mysqli_fetch_array($result)) {
                extract($row); ?>
        <div class="explain">
            <p style="font-weight: bold;"><?php echo $title ?></p>
            <p>
            <?php echo $content ?>
            </p><br>
        </div>
        <?php } ?>
    <?php } ?>
    </section>
        
    <section>
    <div class="select">
        <div class="buying">
            <a href="order.php"><h2>Order</h2></a>
        </div>
        <div class="heart">
            <?php 
                if(isset($_SESSION['logged_email'])) {
                    $query = "SELECT productID
                                FROM liked
                                WHERE email = '$emailID'";
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));
                    $tmp = 0;
                    while($row = mysqli_fetch_array($result)) {
                        extract($row);
                        if($productID == $product_ID) { 
                            $tmp = 1;
                            break; 
                        }       
                        $tmp = 0;
                    } 
                } ?>
            <?php 
                if($tmp == 1) { ?>
                    <a href="product.php?id=<?php echo $product_ID; ?>&heart=0"><h2>❤</h2></a>
                <?php } else { ?>
                    <a href="product.php?id=<?php echo $product_ID; ?>&heart=1"><h2>♡</h2></a>
                <?php } ?>
        </div>
    </div>
    </section>
    
    <br>
    <hr>
    <br><br>
    <h3>Review</h3><br>
    <section>
        <div class="review">
            <div class="past">
                <?php
                if(isset($_GET['id'])) {
                $user = 'root';
                $pass = '';
    
                /*
                    An error occurred because it matched the existing MySQL port number, so I changed the port number to 3307 and proceeded with the project.
                */
                $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
                mysqli_select_db($db, 'project') or die(mysqli_error($db));
                $query = "SELECT comment, email
                          FROM comment
                          WHERE productID = '$product_ID'";
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                
                if(mysqli_num_rows($result) == 0) { ?>
                    <div class="box">
                        <div class="comment">
                            <p><span style="font-weight: bold; color: blue;">Comments : </span>None</p>
                        </div>
                        <div class="nickname">
                            <p><span style="font-weight: bold; color: blueviolet;">NickName : </span>None</p>
                        </div>
                    </div>
                <?php } 
                else {
                    while($row = mysqli_fetch_array($result)) {
                        extract($row);
                        echo '<div class="box">';
                        echo '<div class="comment">';
                        echo '<p><span style="font-weight: bold; color: blue;">Comments : </span>' . $comment . '</p>';
                        echo '</div>';

                        $query2 = "SELECT nickName
                                FROM member
                                WHERE email = '$email'";
                        $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
                        while($row2 = mysqli_fetch_array($result2)) {
                            extract($row2);
                            echo '<div class="nickname">';
                            echo '<p><span style="font-weight: bold; color: blueviolet;">NickName : </span>' . $nickName . '</p>';
                            echo '</div>';
                        }
                        echo '</div>';
                        }
                    }   
                }
                ?>
            </div>
        </div>
        <form method="post" action="product.php?id=<?php echo $product_ID; ?>">
            <fieldset style="display: flex;">
            <div style="margin: 20px;">
                <textarea name="comment" id="comment" rows="5" cols="150" placeholder=" Please leave your thoughts...." required></textarea>
            </div>
            <div style="margin-top: 70px; margin-left: 5px;">
                <button type="submit">Submit</button>
            </div>
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