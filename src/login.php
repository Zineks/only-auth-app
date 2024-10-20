<?php
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = selectOne('users', ['email' => $email]);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];

        header("Location: index.php?page=dashboard");
        exit();
    } else {
        $errorMsg = 'Неверные email или пароль.';
    }
}
?>

<div class="container">
    <h2 class="mb-3">Вход</h2>
    <?php if (isset($errorMsg)): ?>
        <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Почта или телефон</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>