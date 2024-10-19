<?php
session_start();
include_once 'config/db.php';
include_once 'includes/header.php';

$isLoggedIn = isset($_SESSION['user_name']);

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = $isLoggedIn ? 'dashboard' : 'login';
}

$pages = [
    'register' => 'src/register.php',
    'profile' => 'src/profile.php',
    'dashboard' => 'src/dashboard.php',
    'login' => 'src/login.php',
    'logout' => 'src/logout.php',
];

include_once isset($pages[$page]) ? $pages[$page] : $pages['login'];

if ($isLoggedIn && ($page === 'login' || $page === 'register')) {
    header("Location: index.php?page=dashboard");
    exit();
} elseif (!$isLoggedIn && $page === 'dashboard') {
    header("Location: index.php?page=login");
    exit();
}

include_once isset($pages[$page]) ? $pages[$page] : $pages['login'];

include_once 'includes/footer.php';