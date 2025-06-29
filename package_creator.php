<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Travel Package</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-100 ">
<?php include 'things/navbar.php';   ?>

  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">✈️ Create a Travel Package</h2>

    <div class="mb-4 text-sm text-gray-700">
      <span id="selection-path" class="font-medium">You selected: </span>
      <span id="selected-country" class="text-blue-700"></span>
      <span id="selected-city" class="text-green-700"></span>
      <span id="selected-hotel" class="text-purple-700"></span>
    </div>

    <div id="step-country">
      <h3 class="text-lg font-semibold mb-2">1. Select a Country</h3>
      <div id="countries" class="flex flex-wrap gap-2"></div>
    </div>

    <div id="step-city" class="mt-6 hidden">
      <h3 class="text-lg font-semibold mb-2">2. Select a City</h3>
      <div id="cities" class="flex flex-wrap gap-2"></div>
    </div>

    <div id="step-hotel" class="mt-6 hidden">
      <h3 class="text-lg font-semibold mb-2">3. Select a Hotel</h3>
      <div id="hotels" class="flex flex-wrap gap-2"></div>
    </div>

    <div id="step-form" class="mt-6 hidden"></div>
  </div>

  <script>
    // Load Countries on Page Load
    $.get('ajax/get_countries.php', function(data) 
    {
      $('#countries').html(data);
    });

    // Load Cities when Country clicked
    function loadCities(country) 
    {
      $('#step-country button').removeClass('bg-blue-700').addClass('bg-blue-500');
      $("button:contains('" + country + "')").removeClass('bg-blue-500').addClass('bg-blue-700');

      $('#selected-country').text(' > ' + country);
      $('#selected-city').text('');
      $('#selected-hotel').text('');

      $.post('ajax/get_cities.php', { country: country }, function(data) 
      {
        $('#step-city').removeClass('hidden');
        $('#cities').html(data);
        $('#step-hotel').addClass('hidden');
        $('#step-form').addClass('hidden');
      });
    }

    // Load Hotels when City clicked
    function loadHotels(city) 
    {
      $('#step-city button').removeClass('bg-green-700').addClass('bg-green-500');
      $("button:contains('" + city + "')").removeClass('bg-green-500').addClass('bg-green-700');

      $('#selected-city').text(' > ' + city);
      $('#selected-hotel').text('');

      $.post('ajax/get_hotels.php', { city: city }, function(data) 
      {
        $('#step-hotel').removeClass('hidden');
        $('#hotels').html(data);
        $('#step-form').addClass('hidden');
      });
    }

    // Load Form when Hotel clicked
    function loadForm(hotelId, locationId) 
    {
      $('#step-hotel button').removeClass('bg-purple-700').addClass('bg-purple-500');
      $("#hotels button[onclick*='" + hotelId + "']").removeClass('bg-purple-500').addClass('bg-purple-700');

      const hotelName = $("#hotels button[onclick*='" + hotelId + "']").text();
      $('#selected-hotel').text(' > ' + hotelName);

      $.post('ajax/get_form.php', { hotel_id: hotelId, location_id: locationId }, function(data) 
      {
        $('#step-form').removeClass('hidden');
        $('#step-form').html(data);
      });
    }

    // 👇 Make functions globally accessible from HTML buttons
    window.loadCities = loadCities;
    window.loadHotels = loadHotels;
    window.loadForm = loadForm;
  </script>
</body>
<?php include 'things/footer.php';   ?>

</html>