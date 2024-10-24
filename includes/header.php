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
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=profile">Профиль</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="../index.php?page=logout">Выйти</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=login">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php?page=register">Регистрация</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
</body>
</html>