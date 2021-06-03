<?php
// Incarcam toate fisierele necesare pentru buna functionare a site-ului

// incepem sesiunea
session_start();

// includem fisierul de configurare
include_once 'config.php';

// verificam sesiunea
include_once 'helpers/check_remember.php';

// incarcam automat toate clasele din fisierul 'classes'
include_once 'includes/autoloader.php';
$users = new Users();
$posts = new Posts();

// incarcam functiile utile
include_once 'includes/useful_functions.php';