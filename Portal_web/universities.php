<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universidades por País</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .search-container {
            max-width: 800px;
            margin: 0 auto 3rem;
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .university-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
        }
        .university-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .university-header {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: white;
            padding: 1.5rem;
            position: relative;
        }
        .university-header:after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .university-name {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }
        .university-country {
            font-size: 0.9rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }
        .university-body {
            padding: 1.5rem;
            background: white;
        }
        .university-domain {
            background: #f8f9fa;
            padding: 0.5rem;
            border-radius: 5px;
            font-family: monospace;
            font-size: 0.9rem;
            word-break: break-all;
        }
        .btn-visit {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            border: none;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s;
        }
        .btn-visit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        .title-underline {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
        .title-underline:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
        }
        .university-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            opacity: 0.2;
            color: white;
            z-index: 1;
        }
        .results-count {
            background: #0072ff;
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-left: 1rem;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-graduation-cap me-2"></i>Portal API PHP
            </a>
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

    <div class="container py-5">
        <div class="search-container">
            <h2 class="text-center title-underline">
                <i class="fas fa-university me-2"></i>Universidades por País
            </h2>
            <form method="GET">
                <div class="mb-4">
                    <label for="country" class="form-label fs-5">Buscar universidades en:</label>
                    <input type="text" name="country" id="country" class="form-control form-control-lg" 
                           placeholder="Ejemplo: México, España, Colombia, United States" required>
                    <div class="form-text">Puedes escribir el nombre en español o inglés</div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 btn-visit">
                    <i class="fas fa-search me-2"></i>Buscar Universidades
                </button>
            </form>
        </div>

        <?php
        if (isset($_GET['country']) && !empty($_GET['country'])) {
            $input = strtolower(trim($_GET['country']));

            // Diccionario de países en español → inglés
            $paises = [
                "república dominicana" => "Dominican Republic",
                "mexico" => "Mexico",
                "méxico" => "Mexico",
                "colombia" => "Colombia",
                "españa" => "Spain",
                "argentina" => "Argentina",
                "estados unidos" => "United States",
                "peru" => "Peru",
                "perú" => "Peru",
                "venezuela" => "Venezuela",
                "chile" => "Chile",
                "uruguay" => "Uruguay",
                "panamá" => "Panama",
                "ecuador" => "Ecuador",
                "costa rica" => "Costa Rica",
                "bolivia" => "Bolivia",
                "brasil" => "Brazil",
                "brasil (portugués)" => "Brazil"
            ];

            $country = $paises[$input] ?? $_GET['country'];
            $url = "http://universities.hipolabs.com/search?country=" . urlencode($country);

            $response = @file_get_contents($url);
            if ($response !== false) {
                $data = json_decode($response, true);

                if (!empty($data)) {
                    echo '<div class="d-flex align-items-center mb-4">
                            <h3 class="mb-0">Resultados para: <strong>'.htmlspecialchars($_GET['country']).'</strong></h3>
                            <span class="results-count">'.count($data).' universidades</span>
                          </div>';
                    
                    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">';
                    foreach ($data as $uni) {
                        echo '<div class="col">
                                <div class="university-card">
                                    <div class="university-header">
                                        <i class="fas fa-university university-icon"></i>
                                        <h3 class="university-name">'.$uni['name'].'</h3>
                                        <div class="university-country">
                                            <i class="fas fa-map-marker-alt me-1"></i> '.$country.'
                                        </div>
                                    </div>
                                    <div class="university-body">
                                        <div class="mb-3">
                                            <h6 class="mb-2">Dominio:</h6>
                                            <div class="university-domain">'.($uni['domains'][0] ?? 'No disponible').'</div>
                                        </div>
                                        <a href="'.$uni['web_pages'][0].'" class="btn btn-primary btn-sm btn-visit" target="_blank">
                                            <i class="fas fa-external-link-alt me-2"></i>Visitar Sitio
                                        </a>
                                    </div>
                                </div>
                              </div>';
                    }
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning text-center py-3">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            No se encontraron universidades para el país indicado.
                          </div>';
                }
            } else {
                echo '<div class="alert alert-danger text-center py-3">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Error al conectarse con la API de universidades.
                      </div>';
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>