<?php 
    session_start();
    if(empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type']!== 'user') ){
        header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
    }
    else{
        $customer_id = $_SESSION['id'];
        $package_id = $_GET['id'];
        include 'things/db_connect.php';
        $query1 = "SELECT * FROM customer WHERE id = ' $customer_id';";
        $query2 = "SELECT * FROM packages WHERE id = ' $customer_id';";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
    }

?>

<?php include("things/top.php") ?>
<body>
<?php include("things/navbar.php") ?>
    
</body>
<?php include("things/footer.php") ?>

</html>

