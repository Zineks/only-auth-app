<div class="container">
    <form action="login.php" method="POST">
        <h2 class="mb-3">Авторизация</h2>
        <div class="mb-3">
            <label for="login" class="form-label">Email или телефон</label>
            <input type="text" class="form-control" id="login" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
