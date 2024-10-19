<?php
$errorMsg = '';
$name = '';
$phone_number = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $phone_number = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Валидация данных
    if (strlen($name) < 2) {
        $errorMsg = 'Имя должно содержать не менее двух символов.';
    } elseif (strlen($phone_number) > 20) {
        $errorMsg = 'Номер телефона должен содержать до 20 цифр.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Введите корректный адрес электронной почты.';
    } elseif ($password !== $confirm_password) {
        $errorMsg = 'Пароли не совпадают.';
    } else {
        if (selectOne('users', ['email' => $email])) {
            $errorMsg = 'Пользователь с таким email уже зарегистрирован.';
        }

        if (selectOne('users', ['phone_number' => $phone_number])) {
            $errorMsg = 'Пользователь с таким номером телефона уже зарегистрирован.';
        }

        if (empty($errorMsg)) {
            $hashedPass = password_hash($password, PASSWORD_DEFAULT);

            $newUserId = insert('users', [
                'name' => $name,
                'phone_number' => $phone_number,
                'email' => $email,
                'password' => $hashedPass
            ]);

            if ($newUserId) {
                $_SESSION['user_id'] = $newUserId;
                $_SESSION['user_name'] = $name;

                header("Location: index.php?page=dashboard");
                exit();
            } else {
                $errorMsg = 'Ошибка!';
            }
        }
    }
}
?>

<div class="container">
    <form action="" method="POST">
        <h2 class="mb-3">Регистрация</h2>
        <?php if ($errorMsg): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMsg; ?>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone_number); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Почта</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Повторите пароль</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>
