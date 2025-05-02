<?php
$cities = [
    ["name" => "Paris", "lat" => 48.8566, "lon" => 2.3522],
    ["name" => "Bangkok", "lat" => 13.7563, "lon" => 100.5018],
    ["name" => "Istanbul", "lat" => 41.0082, "lon" => 28.9784],
    ["name" => "London", "lat" => 51.5074, "lon" => -0.1278],
    ["name" => "Dubai", "lat" => 25.276987, "lon" => 55.296249],
    ["name" => "Rome", "lat" => 41.9028, "lon" => 12.4964],
    ["name" => "Tokyo", "lat" => 35.6762, "lon" => 139.6503],
    ["name" => "Athens", "lat" => 37.9838, "lon" => 23.7275] // Greece = Athens
];

$weatherData = [];

foreach ($cities as $city) {
    $url = "https://api.open-meteo.com/v1/forecast?latitude={$city['lat']}&longitude={$city['lon']}&current_weather=true&timezone=auto";
    $response = @file_get_contents($url);
    if ($response !== false) {
        $json = json_decode($response, true);
        $weatherData[] = [
            "city" => $city["name"],
            "temp" => $json["current_weather"]["temperature"],
            "wind" => $json["current_weather"]["windspeed"],
            "time" => $json["current_weather"]["time"]
        ];
    } else {
        $weatherData[] = [
            "city" => $city["name"],
            "temp" => "N/A",
            "wind" => "N/A",
            "time" => "N/A"
        ];
    }
}
?>

<?php include 'things/top.php';?>
<body class="bg-gray-100 min-h-screen">
<?php include 'things/navbar.php';?>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">🌍 Live Weather in Popular Cities</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($weatherData as $weather): ?>
                <div class="bg-white rounded shadow-lg p-5 text-center">
                    <h2 class="text-xl font-semibold text-blue-700"><?= $weather["city"] ?></h2>
                    <p class="text-gray-700 mt-2">🌡️ Temperature: <strong><?= $weather["temp"] ?>°C</strong></p>
                    <p class="text-gray-700">💨 Wind Speed: <strong><?= $weather["wind"] ?> km/h</strong></p>
                    <p class="text-gray-600 text-sm mt-2">⏱️ Updated: <?= $weather["time"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<?php include 'things/footer.php';?>

</html>
