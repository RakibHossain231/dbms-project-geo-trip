<?php
include('../things/db_connect.php');
$city = $_POST['city'];
$query = "SELECT h.id, h.name, l.location_id FROM hotels h
          JOIN locations l ON h.location_id = l.location_id
          WHERE l.city = '$city'";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)) 
{
    echo "<button onclick=\"loadForm('{$row['id']}', '{$row['location_id']}')\" class='bg-purple-500 text-white px-4 py-1 rounded'>{$row['name']}</button>";
}
?>
