<?php
session_start();
include_once 'config/db.php';
include_once 'includes/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

$pages = [
    'register' => 'src/register.php',
    'profile' => 'src/profile.php',
    'dashboard' => 'src/dashboard.php',
    'login' => 'src/login.php',
    'logout' => 'src/logout.php',
];

$stmt = $pdo->query('SELECT * FROM users');
while ($row = $stmt->fetch()) {
    echo $row['email'];  // Выведет почтовые адреса всех пользователей
}

include_once isset($pages[$page]) ? $pages[$page] : $pages['login'];

include_once 'includes/footer.php';