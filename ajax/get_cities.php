<?php
include('../things/db_connect.php');
$country = $_POST['country'];
$result = mysqli_query($conn, "SELECT DISTINCT city FROM locations WHERE country = '$country'");
while($row = mysqli_fetch_assoc($result)) 
{
    echo "<button onclick=\"loadHotels('{$row['city']}')\" class='bg-green-500 text-white px-4 py-1 rounded'>{$row['city']}</button>";
}
?>
