<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Imágenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .search-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .gallery-container {
            max-width: 1200px;
            margin: 2rem auto;
        }
        .image-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            border: none;
        }
        .image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .image-wrapper {
            position: relative;
            padding-top: 75%; /* 4:3 Aspect Ratio */
            overflow: hidden;
        }
        .image-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .image-card:hover .image-wrapper img {
            transform: scale(1.03);
        }
        .image-info {
            padding: 1.5rem;
            background: white;
        }
        .image-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
            color: #666;
        }
        .stat-item {
            display: flex;
            align-items: center;
        }
        .stat-item i {
            margin-right: 5px;
            color: #6c757d;
        }
        .search-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        .search-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: linear-gradient(90deg, #4b6cb7, #182848);
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
        }
        .btn-search {
            background: linear-gradient(135deg, #4b6cb7, #182848);
            border: none;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s;
        }
        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
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

<div class="container py-5">
    <div class="search-container">
        <h2 class="search-title text-center mb-4">
            <i class="fas fa-camera me-2"></i>Buscador de Imágenes
        </h2>
        <form method="GET" class="text-center">
            <div class="mb-4">
                <label for="keyword" class="form-label fs-5 mb-3">¿Qué imágenes estás buscando?</label>
                <input type="text" name="keyword" id="keyword" class="form-control form-control-lg" 
                       placeholder="Ejemplo: playa, perro, comida, montañas..." required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-search">
                <i class="fas fa-search me-2"></i>Buscar Imágenes
            </button>
        </form>
    </div>

    <?php
    if (!empty($_GET['keyword'])) {
        $keyword = urlencode(trim($_GET['keyword']));
        $apiKey = "51082490-4eb346f78894deec4de258b1b"; 
        $apiUrl = "https://pixabay.com/api/?key={$apiKey}&q={$keyword}&image_type=photo&lang=es&safesearch=true&per_page=9";

        $response = @file_get_contents($apiUrl);
        if ($response !== false) {
            $data = json_decode($response, true);

            if (!empty($data['hits'])) {
                echo '<div class="gallery-container">';
                echo '<h3 class="text-center mb-4">Resultados para: <strong>"'.htmlspecialchars($_GET['keyword']).'"</strong></h3>';
                echo '<div class="row">';
                
                foreach ($data['hits'] as $image) {
                    echo '<div class="col-md-4">';
                    echo '<div class="image-card">';
                    echo '<div class="image-wrapper">';
                    echo '<img src="'.$image['webformatURL'].'" alt="'.$image['tags'].'" class="img-fluid">';
                    echo '</div>';
                    echo '<div class="image-info">';
                    echo '<p class="mb-2"><strong>'.ucwords($image['tags']).'</strong></p>';
                    echo '<div class="image-stats">';
                    echo '<span class="stat-item"><i class="fas fa-thumbs-up"></i> '.$image['likes'].'</span>';
                    echo '<span class="stat-item"><i class="fas fa-eye"></i> '.$image['views'].'</span>';
                    echo '<span class="stat-item"><i class="fas fa-download"></i> '.$image['downloads'].'</span>';
                    echo '</div></div></div></div>';
                }
                
                echo '</div></div>';
            } else {
                echo '<div class="alert alert-warning text-center py-3">';
                echo '<i class="fas fa-image me-2"></i>';
                echo 'No se encontraron imágenes para "'.htmlspecialchars($_GET['keyword']).'"';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-danger text-center py-3">';
            echo '<i class="fas fa-exclamation-triangle me-2"></i>';
            echo 'No se pudo conectar con la API de Pixabay. Inténtalo de nuevo más tarde.';
            echo '</div>';
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>