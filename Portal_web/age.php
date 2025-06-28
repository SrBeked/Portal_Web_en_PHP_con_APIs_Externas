<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predicción de Edad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .age-card {
            max-width: 400px;
            margin: 0 auto;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            border: none;
        }
        .age-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .age-header {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .age-body {
            padding: 2rem;
            text-align: center;
        }
        .age-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .age-image {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin: 0 auto 1.5rem;
            display: block;
            border-radius: 50%;
            background: #f8f9fa;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .age-value {
            font-size: 3rem;
            font-weight: bold;
            color: #28a745;
            margin: 0.5rem 0;
        }
        .age-category {
            background: #e9ecef;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            display: inline-block;
            margin: 0.5rem 0;
            font-weight: 500;
        }
        .count-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0,0,0,0.2);
            color: white;
            border-radius: 10px;
            padding: 3px 8px;
            font-size: 0.8rem;
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
        <h2 class="mb-4 text-center">Predicción de Edad</h2>
        <form method="GET" class="mb-4">
            <div class="mb-3">
                <label for="name" class="form-label">Ingresa un nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Estimar Edad</button>
        </form>

        <?php
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $name = htmlspecialchars($_GET['name']);
            $url = "https://api.agify.io/?name=" . urlencode($name);

            $response = @file_get_contents($url);
            if ($response !== false) {
                $data = json_decode($response, true);
                if (isset($data['age']) && $data['age'] !== null) {
                    $age = $data['age'];
                    $count = $data['count'] ?? 0;

                    if ($age <= 12) {
                        $categoria = "Niñ@ 👧🏻👦🏻";
                        $img = "https://cdn-icons-png.flaticon.com/512/3003/3003984.png";
                        $bgColor = "#f8d7da";
                    } elseif ($age <= 59) {
                        $categoria = "Adult@ 👨🏻🧑🏻";
                        $img = "https://cdn-icons-png.flaticon.com/512/4333/4333609.png";
                        $bgColor = "#d1e7dd";
                    } else {
                        $categoria = "Ancian@ 👴🏻👵🏻 ";
                        $img = "https://cdn-icons-png.flaticon.com/512/4007/4007331.png";
                        $bgColor = "#fff3cd";
                    }

                    echo "<div class='card age-card'>
                            <div class='age-header position-relative'>
                                <h3>Resultado de Edad</h3>
                                <span class='count-badge'>Muestras: {$count}</span>
                            </div>
                            <div class='age-body'>
                                <img src='{$img}' alt='Imagen de categoría' class='age-image'>
                                <h4 class='mb-3'><strong>{$name}</strong></h4>
                                <div class='age-value'>{$age}</div>
                                <small class='text-muted'>años</small>
                                <div class='age-category mt-3'>{$categoria}</div>
                                <div class='mt-4'>
                                    <small class='text-muted'>Edad estimada basada en datos estadísticos</small>
                                </div>
                            </div>
                        </div>";
                } else {
                    echo "<div class='alert alert-warning text-center'>No se pudo estimar la edad para el nombre ingresado.</div>";
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