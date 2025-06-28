<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chistes Aleatorios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .joke-container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .joke-card {
            border-radius: 12px;
            padding: 2rem;
            margin: 2rem 0;
            position: relative;
            overflow: hidden;
            border: none;
            transition: all 0.3s ease;
        }
        .single-joke {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            border-left: 5px solid #4b6cb7;
        }
        .twopart-joke {
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
            border-left: 5px solid #00acc1;
        }
        .joke-setup {
            font-size: 1.3rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            position: relative;
        }
        .joke-delivery {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d32f2f;
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            position: relative;
        }
        .joke-delivery:before {
            content: "😂";
            position: absolute;
            left: -25px;
            top: 50%;
            transform: translateY(-50%);
        }
        .joke-delivery:after {
            content: "😂";
            position: absolute;
            right: -25px;
            top: 50%;
            transform: translateY(-50%);
        }
        .btn-new-joke {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            border: none;
            padding: 0.7rem 2rem;
            font-weight: 500;
            letter-spacing: 1px;
            transition: all 0.3s;
        }
        .btn-new-joke:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .joke-icon {
            position: absolute;
            font-size: 5rem;
            opacity: 0.1;
            z-index: 0;
        }
        .joke-icon-1 {
            top: -20px;
            right: -20px;
        }
        .joke-icon-2 {
            bottom: -20px;
            left: -20px;
        }
        .title-underline {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }
        .title-underline:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 4px;
            background: linear-gradient(90deg, #ff9a9e, #fad0c4);
            bottom: -10px;
            left: 25%;
            border-radius: 3px;
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
    <div class="joke-container text-center">
        <h2 class="title-underline">
            <i class="fas me-2"></i>Chiste Aleatorio
        </h2>

        <?php
        $url = "https://v2.jokeapi.dev/joke/Any?lang=es";

        $response = @file_get_contents($url);
        if ($response !== false) {
            $data = json_decode($response, true);

            if ($data["type"] === "single") {
                echo '<div class="joke-card single-joke position-relative">';
                echo '<i class="fas fa-grin-squint-tears joke-icon joke-icon-1"></i>';
                echo '<i class="fas fa-smile-wink joke-icon joke-icon-2"></i>';
                echo '<div class="position-relative" style="z-index: 1;">';
                echo '<p class="fs-4 fst-italic">"'.$data['joke'].'"</p>';
                echo '</div></div>';
            } elseif ($data["type"] === "twopart") {
                echo '<div class="joke-card twopart-joke position-relative">';
                echo '<i class="fas fa-grin-tongue-wink joke-icon joke-icon-1"></i>';
                echo '<i class="fas fa-grin-tongue-squint joke-icon joke-icon-2"></i>';
                echo '<div class="position-relative" style="z-index: 1;">';
                echo '<div class="joke-setup">'.$data['setup'].'</div>';
                echo '<div class="joke-delivery d-inline-block">'.$data['delivery'].'</div>';
                echo '</div></div>';
            } else {
                echo '<div class="alert alert-warning">';
                echo '<i class="fas fa-meh me-2"></i>No se pudo obtener un chiste válido.';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-danger">';
            echo '<i class="fas fa-frown me-2"></i>No se pudo conectar con la API de chistes.';
            echo '</div>';
        }
        ?>

        <a href="joke.php" class="btn btn-primary btn-lg btn-new-joke mt-3">
            <i class="fas fa-redo me-2"></i>Otro Chiste
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>