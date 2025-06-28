<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversión de Monedas</title>
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
    <h2 class="mb-4">Conversión de Monedas</h2>
    <form method="GET" class="mb-4">
        <label for="amount" class="form-label">Ingresa la cantidad en USD:</label>
        <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
        <button type="submit" class="btn btn-success mt-2">Convertir</button>
    </form>

    <?php
    if (isset($_GET['amount']) && is_numeric($_GET['amount'])) {
        $amount = floatval($_GET['amount']);
        $url = "https://api.exchangerate-api.com/v4/latest/USD";

        $response = @file_get_contents($url);
        if ($response !== false) {
            $data = json_decode($response, true);
            $rates = $data['rates'];

            $dop = round($amount * $rates['DOP'], 2);
            $eur = round($amount * $rates['EUR'], 2);
            $mxn = round($amount * $rates['MXN'], 2);

            echo "<div class='card p-4 shadow-sm'>
                    <h5 class='mb-3'>Resultados para <strong>\${$amount} USD</strong>:</h5>
                    <ul class='list-group'>
                        <li class='list-group-item'>🇩🇴 Pesos dominicanos: <strong>{$dop} DOP</strong></li>
                        <li class='list-group-item'>🇪🇺 Euros: <strong>{$eur} EUR</strong></li>
                        <li class='list-group-item'>🇲🇽 Pesos mexicanos: <strong>{$mxn} MXN</strong></li>
                    </ul>
                  </div>";
        } else {
            echo "<div class='alert alert-danger'>No se pudo obtener información de cambio.</div>";
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
