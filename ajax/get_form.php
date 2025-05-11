<?php
include('../things/db_connect.php');
$hotel_id = $_POST['hotel_id'];
$location_id = $_POST['location_id'];
?>

<form method="POST" action="ajax/save_package.php" class="grid grid-cols-2 gap-4 mt-4">
  <input type="hidden" name="hotel_id" value="<?= $hotel_id ?>">
  <input type="hidden" name="location_id" value="<?= $location_id ?>">

  <!-- Price -->
  <div class="mb-4">
    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
    <input type="text" name="price" id="price" placeholder="in Taka" class="border p-2 rounded w-full" required>
  </div>

  <!-- Duration -->
  <div class="mb-4">
    <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
    <input type="number" name="duration" id="duration" placeholder="in days" class="border p-2 rounded w-full" required>
  </div>

  <!-- Availability -->
  <div class="mb-4">
    <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
    <input type="number" name="availability" id="availability" placeholder="hotel rooms" class="border p-2 rounded w-full" required>
  </div>

  <!-- Commission Rate -->
  <div class="mb-4">
    <label for="commission_rate" class="block text-sm font-medium text-gray-700">Commission Rate</label>
    <input type="number" name="commission_rate" id="commission_rate" placeholder="Commission Rate" class="border p-2 rounded w-full" required>
  </div>

  <!-- Image URL -->
  <div class="mb-4">
    <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
    <input type="text" name="image_url" id="image_url" placeholder="You must give the device path" class="border p-2 rounded w-full">
  </div>

  <!-- start Date -->
  <div class="mb-4">
    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
    <input type="date" name="start_date" id="start_date" class="border p-2 rounded w-full" required>
  </div>


  <!-- Description -->
  <div class="mb-4 col-span-2">
    <label for="descriptions" class="block text-sm font-medium text-gray-700">Package Description [Use The file sentence for title]</label>
    <textarea name="descriptions" id="descriptions" placeholder="Describe about Package" class="border p-2 rounded w-full" required></textarea>
  </div>

  <!-- Save Package Button -->
  <div class="col-span-2">
    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded w-full">Save Package</button>
  </div>
</form>
