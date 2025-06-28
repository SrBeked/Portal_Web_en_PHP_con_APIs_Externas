<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .profile-img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }
        .profile-img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .profile-info {
            padding: 2.5rem;
        }
        .info-item {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .info-label {
            font-weight: 600;
            color: #4b6cb7;
            min-width: 120px;
            display: inline-block;
        }
        .tools-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        @media (max-width: 768px) {
            .profile-img {
                width: 250px;
                height: 250px;
            }
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
    <div class="profile-card shadow-lg">
        <h2 class="text-center py-4 mb-0">Acerca de Mi</h2>
        <div class="row align-items-center">
            <div class="col-md-5 profile-img-container">
                <img src="https://plataformavirtual.itla.edu.do/pluginfile.php/711494/user/icon/fordson/f1?rev=80985479" 
                     alt="Foto de Ismel Amaury AM" 
                     class="profile-img">
            </div>
            <div class="col-md-7 profile-info">
                <div class="info-item">
                    <span class="info-label">Nombre:</span>
                    Ismel Amaury AM
                </div>
                <div class="info-item">
                    <span class="info-label">Carrera:</span>
                    Desarrollo de Software
                </div>
                <div class="info-item">
                    <span class="info-label">Correo:</span>
                    <a href="mailto:20231886@itla.edu.do">20231886@itla.edu.do</a>
                </div>
                <div class="info-item">
                    <span class="info-label">Ubicación:</span>
                    República Dominicana
                </div>
                
                <div class="tools-section">
                    <h5 class="mb-3">Herramientas utilizadas</h5>
                    <p>Este portal fue desarrollado usando <strong>PHP puro</strong> y el framework de estilos <strong>Bootstrap 5</strong>, que permite una interfaz limpia, moderna y totalmente responsive sin complicaciones. La elección de Bootstrap se basó en su facilidad de uso, compatibilidad móvil y amplia documentación.</p>
                    <p>Además, se integraron múltiples APIs públicas para ofrecer funcionalidades prácticas y divertidas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>