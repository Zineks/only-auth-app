<?php
    if (!isset($_SESSION['user_id'])) {
        die("Пользователь не авторизован.");
    }

    $user = selectOne('users', ['id' => $_SESSION['user_id']]);
    if (!$user) {
        die("Пользователь не найден.");
    }

    $errorMsg = '';
    $successMsg = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $phone_number = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $current_password = trim($_POST['current_password']);
        $new_password = trim($_POST['new_password']);
        $confirm_new_password = trim($_POST['confirm_new_password']);

        if (!password_verify($current_password, selectOne('users', ['id' => $_SESSION['user_id']])['password'])) {
            $errorMsg = 'Неверный текущий пароль.';
        } elseif ($new_password !== $confirm_new_password) {
            $errorMsg = 'Пароли не совпадают.';
        } else {
            $params = [
                'name' => $name,
                'phone_number' => $phone_number,
                'email' => $email,
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            update('users', $_SESSION['user_id'], $params);
            $successMsg = 'Данные успешно обновлены.';
        }
    }
?>

<div class="container">
    <form action="" method="POST">
        <h2 class="mb-3">Ваш профиль</h2>

        <?php if ($errorMsg): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($errorMsg); ?>
            </div>
        <?php endif; ?>

        <?php if ($successMsg): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($successMsg); ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="mb-3 row">
            <div class="col-5">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            <div class="col">
                <label for="email" class="form-label">Почта</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="current_password" class="form-label">Текущий пароль</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="new_password" class="form-label">Новый пароль</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="col">
                <label for="confirm_new_password" class="form-label">Подтвердите новый пароль</label>
                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
