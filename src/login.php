<?php
    $login = '';
    define('SMARTCAPTCHA_SERVER_KEY', ''); // Вставить токен

    function check_captcha($token)
    {
        $ch = curl_init();

        $args = http_build_query([
            "secret" => SMARTCAPTCHA_SERVER_KEY,
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR'],
        ]);

        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);
        $smartToken = isset($_POST['smart-token']) ? $_POST['smart-token'] : '';

        if (!$smartToken) {
            $errorMsg = 'Ошибка проверки капчи, попробуйте еще раз.';
        } else {

            $httpcode = check_captcha($smartToken);

            if ($httpcode !== 0) {
                $errorMsg = "Ошибка капчи, попробуйте еще раз.";
            } else {
                if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                    $user = selectOne('users', ['email' => $login]);
                } else {
                    $user = selectOne('users', ['phone_number' => $login]);
                }

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_id'] = $user['id'];

                    header("Location: index.php?page=dashboard");
                    exit();
                } else {
                    $errorMsg = 'Неверная почта/телефон или пароль.';
                }
            }
        }
    }
?>

<div class="container">
    <h2 class="mb-3">Вход</h2>
    <form action="" method="POST">
        <?php if (isset($errorMsg)): ?>
            <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="login" class="form-label">Почта или телефон</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div
            style="height: 100px"
            id="captcha-container"
            class="smart-captcha mb-3"
            data-sitekey="ysc1_QPsfIjQ8dpCaPODUN5dV3p58FvWBDoaQnS39fRkc7c3bf3e6"
        ></div>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>

<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>