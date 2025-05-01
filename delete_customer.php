<?php 
include 'things/top.php';
include 'things/db_connect.php';
?>

<?php 
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $id = $_GET['id'];
        $query = " SELECT * FROM customer WHERE customerId = $id;";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
    }
    if($_SERVER['REQUEST_METHOD']==='POST' && !empty($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM customer WHERE customerId = $id;";
        $data = mysqli_query($conn, $query);
        if($data){
            ?>
            <!-- a small message about deletation -->
            <script>alert("Customer Deleted Successfully")</script>
            <?php
            sleep(1);
            mysqli_close($conn);
            header('Location: customers_list.php?msg=Customer+deleted+successfully');
            exit();
        }else{
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

?>
<body>
<?php include 'things/navbar.php' ?>  

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
      <p><span class=" font-semibold text-red-400">Are You Sure you want to delete This customer?</span></p>
      <form action="delete_customer.php?id=<?php echo $_GET['id'] ?>" method="POST">
        <input type="submit" value= "Delete" class="bg-black text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
      </form>
    </div>
  </div>
</div>

  
</body>
<?php include 'things/footer.php' ?>
</html>
