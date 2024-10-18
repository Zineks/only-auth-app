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

include_once isset($pages[$page]) ? $pages[$page] : $pages['login'];

include_once 'includes/footer.php';