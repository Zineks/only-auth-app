<!-- includes/header.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">AuthApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=login">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=register">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=dashboard">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../src/logout.php">Выйти</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
