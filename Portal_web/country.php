<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de País</title>
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
    <h2 class="mb-4 text-center">Información de un País</h2>

    <form method="GET" class="mb-4 text-center">
        <label for="country" class="form-label">Escribe el nombre del país:</label>
        <input type="text" name="country" id="country" class="form-control w-50 mx-auto mb-2" placeholder="ej: República Dominicana, Colombia, España" required>
        <button type="submit" class="btn btn-primary">Buscar País</button>
    </form>

    <?php
    if (!empty($_GET['country'])) {
        $countryInput = trim($_GET['country']);
        $encodedCountry = urlencode($countryInput);

        // Usamos el endpoint que busca por traducción del nombre del país
        $apiUrl = "https://restcountries.com/v3.1/translation/{$encodedCountry}";

        $response = @file_get_contents($apiUrl);
        if ($response !== false) {
            $data = json_decode($response, true);

            if (!empty($data[0])) {
                $pais = $data[0];
                $nombre = $pais['translations']['spa']['common'] ?? $pais['name']['common'];
                $capital = $pais['capital'][0] ?? 'N/A';
                $poblacion = number_format($pais['population']);
                $bandera = $pais['flags']['png'] ?? '';
                $monedas = [];

                if (isset($pais['currencies']) && is_array($pais['currencies'])) {
                    foreach ($pais['currencies'] as $codigo => $info) {
                        $monedas[] = "{$info['name']} ({$codigo})";
                    }
                }

                echo "<div class='card text-center shadow-sm p-4'>
                        <h4 class='card-title mb-3'>Información de <strong>{$nombre}</strong></h4>
                        <img src='{$bandera}' alt='Bandera de {$nombre}' class='img-fluid mb-3' style='max-width: 150px;'>
                        <p><strong>Capital:</strong> {$capital}</p>
                        <p><strong>Población:</strong> {$poblacion} habitantes</p>
                        <p><strong>Moneda:</strong> " . implode(', ', $monedas) . "</p>
                      </div>";
            } else {
                echo "<div class='alert alert-warning text-center'>No se encontró información del país solicitado.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>No se pudo conectar con la API.</div>";
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
