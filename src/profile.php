<div class="container">
    <form action="profile.php" method="POST">
        <h2 class="mb-3">Ваш профиль</h2>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="" required>
        </div>
        <div class="mb-3 row">
            <div class="col-5">
                <label for="phone" class="form-label">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" value="" required>
            </div>
            <div class="col">
                <label for="email" class="form-label">Почта</label>
                <input type="email" class="form-control" id="email" name="email" value="" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="current_password" class="form-label">Текущий пароль</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="new_password" class="form-label">Новый пароль</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="col">
                <label for="confirm_new_password" class="form-label">Подтвердите новый пароль</label>
                <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
