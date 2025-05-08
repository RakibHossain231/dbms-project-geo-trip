<?php 
session_start();
if(empty($_SESSION['id']) || ((!empty($_SESSION['id'])) && $_SESSION['type']!== 'user') ){
    header("Location: admin_login.php?msg=You+must+login+as+admin+to+access+the+previous+page");
}
else{
    $customer_id = $_SESSION['id'];
    include 'things/db_connect.php';
    $query = " SELECT * FROM customer WHERE customerId = '$customer_id';";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
}

?>
<?php include 'things/top.php';?>
<body>
    <?php include 'things/navbar.php';?>
    <div class="max-w-md mx-auto mt-6">
  <div class="bg-gradient-to-b from-white to-blue-200 shadow-md rounded-2xl p-6 border border-gray-200">
    <h2 class="text-2xl font-bold text-blue-500 mb-4 text-center">Customer Information</h2>
    <hr class="mb-2">
    <div class="space-y-2 text-gray-700 text-md flex flex-col items-center justify-center ">
      <p><span class="font-medium">Customer ID:</span> <?php echo $data['customerID']  ?></p>
      <p><span class="font-medium">First Name:</span> <?php echo $data['f_name']  ?></p>
      <p><span class="font-medium">Last Name:</span> <?php echo $data['l_name']  ?></p>
      <p><span class="font-medium">Date of Birth:</span> <?php echo $data['dob']  ?></p>
      <p><span class="font-medium">Phone:</span> <?php echo $data['phone']  ?></p>
      <p><span class="font-medium">Email:</span> <?php echo $data['email']  ?></p>
      <p><span class="font-medium">Address:</span> <?php echo $data['address']  ?></p>
      <p><span class="font-medium">Nationality:</span> <?php echo $data['nationality']  ?></p>
      <p><span class="font-medium">Passport No:</span> <?php echo $data['pp_no'] ?></p>
      <p><span class="font-medium">Username:</span> <?php echo $data['user_name']  ?></p>
      <p><span class="font-medium">Gender:</span> <?php echo $data['gender']  ?></p>
      <form action="logout.php" method="POST">
        <input type="submit" name="Logout" value= "Logout" class="bg-black text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
      </form>
    </div>
  </div>
</div>
</body>