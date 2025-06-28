<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clima en República Dominicana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Portal API PHP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Clima en República Dominicana</h2>
        <form method="GET" class="mb-4">
            <div class="mb-3">
                <label for="city" class="form-label">Ciudad (ej: Santo Domingo):</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Consultar Clima</button>
        </form>

        <?php
        if (isset($_GET['city']) && !empty($_GET['city'])) {
            $city = htmlspecialchars($_GET['city']);
            $apiKey = "dc61dbf8c6ff9de30c56cbd206737e67"; // <-- reemplaza esto por tu propia API KEY
            $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . ",DO&appid=$apiKey&units=metric&lang=es";

            $response = @file_get_contents($url);
            if ($response !== false) {
                $data = json_decode($response, true);

                if (isset($data['weather'][0])) {
                    $descripcion = ucfirst($data['weather'][0]['description']);
                    $icono = $data['weather'][0]['icon'];
                    $temp = $data['main']['temp'];
                    $ciudad = $data['name'];

                    // Elige emoji según el clima
                    $climaEmoji = "☁️";
                    if (str_contains($descripcion, 'lluvia')) $climaEmoji = "🌧️";
                    elseif (str_contains($descripcion, 'nubes')) $climaEmoji = "☁️";
                    elseif (str_contains($descripcion, 'sol') || str_contains($descripcion, 'despejado')) $climaEmoji = "☀️";

                   echo "<div class='card p-4 shadow-sm text-center'>
                    <h4>$climaEmoji Clima en <strong>{$ciudad}</strong></h4>
                    <p class='fs-5'>Condición: <strong>{$descripcion}</strong></p>
                    <p class='fs-5'>Temperatura: <strong>{$temp} °C</strong></p>
                    <img src='https://static.vecteezy.com/system/resources/previews/001/500/512/non_2x/cloudy-weather-icon-free-vector.jpg' 
                        alt='icono del clima' 
                        class='d-block mx-auto' 
                        style='width: 64px;'>
                </div>";

                } elseif (isset($data['cod']) && $data['cod'] == 404) {
                    echo "<div class='alert alert-warning'>Ciudad no encontrada. Por favor, verifica el nombre de la ciudad.</div>";
                } elseif (isset($data['message'])) {
                    echo "<div class='alert alert-warning'>Ciudad no encontrada: " . htmlspecialchars($data['message']) . "</div>";

                } else {
                    echo "<div class='alert alert-warning'>No se pudo obtener el clima para la ciudad indicada.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Error al conectarse con la API. Revisa tu API key.</div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
