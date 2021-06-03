<?php
// verificam daca au fost setate user_id si user_name in cookie
// initializam din nou sesiunea daca este setat cookie si sesiunea a expirat
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_name'])) {
    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['user_name'] = $_COOKIE['user_name'];
    }
}