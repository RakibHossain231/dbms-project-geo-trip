<?php
include('../things/db_connect.php');
$result = mysqli_query($conn, "SELECT DISTINCT country FROM locations");
while($row = mysqli_fetch_assoc($result)) 
{
    echo "<button onclick=\"loadCities('{$row['country']}')\" class='bg-blue-500 text-white px-4 py-1 rounded'>{$row['country']}</button>";
}
?>
