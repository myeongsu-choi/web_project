<?php
    session_start();

    if(isset($_POST['search'])) {
        $product_name = $_POST['search'];
    }

    $user = 'root';
    $pass = '';
    $db = mysqli_connect('localhost:3307', $user, $pass) or die('Unable to connect. Check your connection parameters');
    mysqli_select_db($db, 'project') or die(mysqli_error($db));

    $query = "SELECT *
            FROM product
            WHERE productName = '$product_name'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result)) {
        extract($row);
        if($productName == $product_name) {
            echo "<script>window.location.href = 'product.php?id=$productID';</script>";
            exit();
        }
    }
    echo "<script>window.location.href = 'search.php?tmp=1';</script>";
    exit();
?>