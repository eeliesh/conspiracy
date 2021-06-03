<?php
include_once 'init.php';
session_start();
// distrugem sesiunea actuala
session_unset();
session_destroy();
// distrugem cookie daca a fost setat
if (isset($_COOKIE['user_id'])) {
    unset($_COOKIE['user_id']);
    setcookie('user_id', null, -1, '/');
}
if (isset($_COOKIE['user_name'])) {
    unset($_COOKIE['user_name']);
    setcookie('user_name', null, -1, '/');
}
redirect('/');