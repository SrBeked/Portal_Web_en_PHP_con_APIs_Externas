<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias desde WordPress</title>
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
    <h2 class="mb-4"> Últimas noticias desde un sitio WordPress</h2>
    <form method="GET" class="mb-4">
        <div class="mb-3">
            <label for="site" class="form-label">URL base del sitio WordPress (sin / al final):</label>
            <input type="text" name="site" id="site" class="form-control" placeholder="https://es.wordpress.org/news" required>
        </div>
        <button type="submit" class="btn btn-primary">Cargar Noticias</button>
    </form>

    <?php
    if (!empty($_GET['site'])) {
        $site = rtrim($_GET['site'], '/'); 
        $apiUrl = $site . "/wp-json/wp/v2/posts?per_page=3";

        $response = @file_get_contents($apiUrl);
        if ($response !== false) {
            $posts = json_decode($response, true);
            if (!empty($posts)) {
                echo "<div class='row row-cols-1 row-cols-md-2 g-4'>";
                foreach ($posts as $post) {
                    $title = $post['title']['rendered'];
                    $excerpt = strip_tags($post['excerpt']['rendered']);
                    $link = $post['link'];

                    echo "<div class='col'>
                            <div class='card h-100 shadow-sm'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$title</h5>
                                    <p class='card-text'>$excerpt</p>
                                    <a href='$link' target='_blank' class='btn btn-outline-primary'>Leer más</a>
                                </div>
                            </div>
                          </div>";
                }
                echo "</div>";
            } else {
                echo "<div class='alert alert-warning'>No se encontraron publicaciones.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>No se pudo conectar con el sitio especificado.</div>";
        }
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
