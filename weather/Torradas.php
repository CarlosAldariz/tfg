<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Meteorolóxica</title> 
    <link rel="stylesheet" href="css.css">
    <style>
        #weather-icon {
            width: 100px;
            height: 100px;
        } 

        body { 
            background-image: url('images/torradas.jpg') !important; 
        }  

        .content { 
            color: black; 
            margin-bottom: 10%;
        }

    </style>
</head>
<body> 
    <?php  

    require '../admin/config.php'; 

    require '../views/header.php';  

    ?> 

    <div class="content">
    <h1>Tempo en Aviño</h1>
    <img id="weather-icon" src="" alt="Icona do Tempo">
    <p id="weather-description"></p>
    <p><strong>Dirección do Vento:</strong> <span id="wind-direction"></span></p>
    <p><strong>Froza do Vento:</strong> <span id="wind-speed"></span> m/s</p>
    <p><strong>Temperatura:</strong> <span id="temperature"></span> ºC</p>
    <p><strong>Temperatura Máxima:</strong> <span id="max-temperature"></span> ºC</p>
    <p><strong>Temperatura Mínima:</strong> <span id="min-temperature"></span> ºC</p> 
    </div>
        
    <?php 
    require '../footer.php';
        ?>

    <script>
        async function getWeather() {
            try {
                const response = await fetch('weather_buño.php');
                const data = await response.json();
                document.getElementById('weather-icon').src = data.weatherIcon;
                document.getElementById('weather-description').innerText = data.weatherDescription;
                document.getElementById('wind-direction').innerText = data.windDirection;
                document.getElementById('wind-speed').innerText = data.windSpeed;
                document.getElementById('temperature').innerText = data.temperature;
                document.getElementById('max-temperature').innerText = data.maxTemperature;
                document.getElementById('min-temperature').innerText = data.minTemperature;
                document.getElementById('sunrise').innerText = data.sunrise;
                document.getElementById('sunset').innerText = data.sunset;
                document.getElementById('uv-index').innerText = data.uvIndex;
            } catch (error) {
                console.error('Erro ao obter os datos meteorolóxicos:', error);
            }
        }
        getWeather();
    </script>
</body>
</html>