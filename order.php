<?php
    session_start();
    if(!isset($_SESSION['logged_email'])) {
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Info</title>
</head>
<body>
    <form method="post" action="ordered.php" style="width:50%;">
        <fieldset>
            <div style="padding: 10px;">
                <label for="quantity">Quantity: </label><br>
                <input type="text" name="quantity" id="quantity" style="width: 90%;" required>
            </div>
            <div style="padding: 10px;">
                <label for="address">Address: </label><br>
                <input type="text" name="address" id="address" style="width: 90%;" required>
            </div>
            <div>
                <?php
                    date_default_timezone_set('Asia/Seoul');
                    $date = date('F d') . ', ' . date('Y');
                ?>
                <input type="hidden" name="date" id="date" value="<?php echo $date; ?>">
            </div>
            <div style="padding: 10px;">
                <button style="margin-top: 5px;" type="submit">Submit</button>
            </div>
        </fieldset>
    </form>
</body>
</html>