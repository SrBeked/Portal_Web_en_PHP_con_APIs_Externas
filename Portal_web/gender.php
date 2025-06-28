<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predicción de Género</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gender-card {
            max-width: 400px;
            margin: 0 auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .gender-card:hover {
            transform: translateY(-5px);
        }
        .male-card {
            border-top: 5px solid #0d6efd;
        }
        .female-card {
            border-top: 5px solid #dc3545;
        }
        .gender-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .probability-bar {
            height: 10px;
            border-radius: 5px;
            background: #e9ecef;
            margin: 15px 0;
        }
        .probability-fill {
            height: 100%;
            border-radius: 5px;
        }
    </style>
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
        <h2 class="mb-4 text-center">Predicción de Género</h2>
        <form method="GET" class="mb-4">
            <div class="mb-3">
                <label for="name" class="form-label">Ingresa un nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Predecir</button>
        </form>

        <?php
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $name = htmlspecialchars($_GET['name']);
            $url = "https://api.genderize.io/?name=" . urlencode($name);

            $response = file_get_contents($url);
            if ($response !== false) {
                $data = json_decode($response, true);
                if (isset($data['gender']) && $data['gender'] !== null) {
                    $isMale = $data['gender'] === 'male';
                    $genderClass = $isMale ? 'male-card' : 'female-card';
                    $genderColor = $isMale ? '#0d6efd' : '#dc3545';
                    $genderText = $isMale ? 'masculino' : 'femenino';
                    $emoji = $isMale ? '👦🏻' : '🧒🏻';
                    $probability = round($data['probability'] * 100);
                    
                    echo "
                    <div class='card gender-card $genderClass'>
                        <div class='card-body text-center py-4'>
                            <div class='gender-icon'>$emoji</div>
                            <h3 class='card-title'>{$name}</h3>
                            <p class='card-text'>El nombre es probablemente:</p>
                            <h2 class='mb-3' style='color: $genderColor'>" . ucfirst($genderText) . "</h2>
                            
                            <div class='probability-bar'>
                                <div class='probability-fill' style='width: {$probability}%; background: $genderColor;'></div>
                            </div>
                            <p class='text-muted'>Probabilidad: {$probability}%</p>
                            
                            <div class='mt-3'>
                                <small class='text-muted'>Conteo de muestras: {$data['count']}</small>
                            </div>
                        </div>
                    </div>";
                } else {
                    echo "<div class='alert alert-warning text-center'>No se pudo determinar el género para el nombre ingresado.</div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>Error al conectarse con la API.</div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>