<?php
$apiKey = 'cd199d35d6fe5304c5d144ae79f1800b';
$cityName = 'carballo';

$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$cityName&appid=$apiKey&lang=gl&units=metric";
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);

$weatherIcon = "http://openweathermap.org/img/wn/{$data['weather'][0]['icon']}.png";
$weatherDescription = $data['weather'][0]['description'];
$windDirection = $data['wind']['deg'];
$windSpeed = $data['wind']['speed'];
$temperature = $data['main']['temp'];
$minTemperature = $data['main']['temp_min'];
$maxTemperature = $data['main']['temp_max'];
$sunrise = date('H:i', $data['sys']['sunrise']);
$sunset = date('H:i', $data['sys']['sunset']);
$uvIndex = isset($data['uv']) ? $data['uv'] : 'N/A';

// Convert wind direction to human readable format
$windDirections = [
    'N' => 'Norte',
    'NNE' => 'Norte-Noroeste',
    'NE' => 'Nordeste',
    'ENE' => 'Este-Noroeste',
    'E' => 'Este',
    'ESE' => 'Este-Sureste',
    'SE' => 'Sueste',
    'SSE' => 'Sur-Sureste',
    'S' => 'Sur',
    'SSW' => 'Sur-Suroeste',
    'SW' => 'Suroeste',
    'WSW' => 'Oeste-Suroeste',
    'W' => 'Oeste',
    'WNW' => 'Oeste-Noroeste',
    'NW' => 'Noroeste',
    'NNW' => 'Norte-Noroeste'
];

$windDirection = $windDirections[getWindDirection($windDirection)];

// Function to get wind direction
function getWindDirection($degrees) {
    $cardinalDirections = array(
        'N' => [348.75, 360],
        'NNE' => [11.25, 33.75],
        'NE' => [33.75, 56.25],
        'ENE' => [56.25, 78.75],
        'E' => [78.75, 101.25],
        'ESE' => [101.25, 123.75],
        'SE' => [123.75, 146.25],
        'SSE' => [146.25, 168.75],
        'S' => [168.75, 191.25],
        'SSW' => [191.25, 213.75],
        'SW' => [213.75, 236.25],
        'WSW' => [236.25, 258.75],
        'W' => [258.75, 281.25],
        'WNW' => [281.25, 303.75],
        'NW' => [303.75, 326.25],
        'NNW' => [326.25, 348.75]
    );
    foreach ($cardinalDirections as $dir => $angles) {
        if ($degrees >= $angles[0] && $degrees < $angles[1]) {
            return $dir;
        }
    }
    return 'N';
}

header('Content-Type: application/json');
echo json_encode([
    'weatherIcon' => $weatherIcon,
    'weatherDescription' => $weatherDescription,
    'windDirection' => $windDirection,
    'windSpeed' => $windSpeed,
    'temperature' => $temperature,
    'minTemperature' => $minTemperature,
    'maxTemperature' => $maxTemperature,
    'sunrise' => $sunrise,
    'sunset' => $sunset,
    'uvIndex' => $uvIndex
]);
?>