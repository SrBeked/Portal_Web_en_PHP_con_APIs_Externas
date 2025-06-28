<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .pokemon-card {
            max-width: 500px;
            margin: 0 auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border: none;
            background: linear-gradient(135deg, #f5f7fa, #e4e8ed);
            position: relative;
        }
        .pokemon-header {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            color: white;
            padding: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .pokemon-header:after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .pokemon-image {
            width: 180px;
            height: 180px;
            object-fit: contain;
            margin: -50px auto 0;
            display: block;
            background: white;
            border-radius: 50%;
            padding: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 5px solid #ff416c;
            position: relative;
            z-index: 2;
        }
        .pokemon-body {
            padding: 2rem;
            text-align: center;
        }
        .pokemon-name {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
            text-transform: capitalize;
        }
        .pokemon-stats {
            display: flex;
            justify-content: space-around;
            margin: 1.5rem 0;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff416c;
        }
        .stat-label {
            font-size: 0.9rem;
            color: #666;
        }
        .abilities-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
            margin: 1.5rem 0;
        }
        .ability-badge {
            background: #ff416c;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            text-transform: capitalize;
        }
        .pokemon-footer {
            background: #f8f9fa;
            padding: 1rem;
            text-align: center;
            border-top: 1px solid #eee;
        }
        .pokeball-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 2rem;
            opacity: 0.2;
            color: white;
        }
        .btn-pokemon {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            border: none;
            padding: 0.7rem 2rem;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-pokemon:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255,75,43,0.3);
        }
        .search-container {
            max-width: 600px;
            margin: 0 auto 3rem;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-pokeball me-2"></i>Portal API PHP
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
            <h2 class="mb-4 text-center text-danger">
                <i class="fas fa-dragon me-2"></i>Información de Pokémon
            </h2>
            <form method="GET">
                <div class="mb-3">
                    <label for="name" class="form-label">Ingresa el nombre del Pokémon (en inglés):</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg" required>
                </div>
                <button type="submit" class="btn btn-danger btn-pokemon btn-lg w-100">
                    <i class="fas fa-search me-2"></i>Buscar Pokémon
                </button>
            </form>
        </div>

        <?php
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $name = strtolower(trim($_GET['name']));
            $url = "https://pokeapi.co/api/v2/pokemon/" . urlencode($name);

            $response = @file_get_contents($url);
            if ($response !== false) {
                $data = json_decode($response, true);
                $img = $data['sprites']['front_default'];
                $exp = $data['base_experience'];
                $abilities = array_map(fn($a) => $a['ability']['name'], $data['abilities']);
                $height = $data['height'] / 10; // Convertir a metros
                $weight = $data['weight'] / 10; // Convertir a kg
                $types = array_map(fn($t) => $t['type']['name'], $data['types']);
                $soundUrl = "https://play.pokemonshowdown.com/audio/cries/{$name}.mp3";

                echo "<div class='pokemon-card mb-5'>
                        <div class='pokemon-header'>
                            <i class='fas fa-pokeball pokeball-icon'></i>
                            <h3 class='text-white'>Pokémon</h3>
                        </div>
                        <img src='{$img}' alt='{$name}' class='pokemon-image'>
                        <div class='pokemon-body'>
                            <h1 class='pokemon-name'>{$name}</h1>
                            
                            <div class='pokemon-stats'>
                                <div class='stat-item'>
                                    <div class='stat-value'>{$exp}</div>
                                    <div class='stat-label'>Experiencia</div>
                                </div>
                                <div class='stat-item'>
                                    <div class='stat-value'>{$height}m</div>
                                    <div class='stat-label'>Altura</div>
                                </div>
                                <div class='stat-item'>
                                    <div class='stat-value'>{$weight}kg</div>
                                    <div class='stat-label'>Peso</div>
                                </div>
                            </div>
                            
                            <h5 class='mt-4'>Tipo:</h5>
                            <div class='abilities-list'>";
                foreach ($types as $type) {
                    echo "<span class='ability-badge'>{$type}</span>";
                }
                echo "</div>
                            
                            <h5 class='mt-4'>Habilidades:</h5>
                            <div class='abilities-list'>";
                foreach ($abilities as $ab) {
                    echo "<span class='ability-badge'>{$ab}</span>";
                }
                echo "</div>
                        </div>
                        <div class='pokemon-footer'>
                            <audio controls class='w-100'>
                                <source src='{$soundUrl}' type='audio/mpeg'>
                                Tu navegador no soporta audio.
                            </audio>
                        </div>
                      </div>";
            } else {
                echo "<div class='alert alert-warning text-center py-3'>
                        <i class='fas fa-exclamation-triangle me-2'></i>
                        No se encontró ningún Pokémon con ese nombre.
                      </div>";
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>