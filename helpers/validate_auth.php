<?php

function validateRegister($data, $userCheck)
{
    $errors = [
        'username_error' => '',
        'email_error' => '',
        'password_error' => '',
        'password_conf_error' => '',
        'captcha_error' => ''
    ];

    // validam usernamer-ul
    if (empty($data['username'])) {
        $errors['username_error'] = "Username-ul nu poate fi gol.";
    } else if (strlen($data['username']) < 3) {
        $errors['username_error'] = "Username-ul trebuie sa contina minim 3 caractere.";
    } else if ($userCheck != false && strcasecmp($data['username'], $userCheck['username']) == 0) {
        $errors['username_error'] = "Un utilizator cu acest username deja exista.";
    }

    // validam email-ul
    if (empty($data['email'])) {
        $errors['email_error'] = "Te rugam sa introduci adresa de email.";
    } else if ($userCheck != false && strcasecmp($data['email'], $userCheck['email']) == 0) {
        $errors['email_error'] = "Un utilizator cu acest email exista deja.";
    }

    // validam parola
    if (empty($data['password'])) {
        $errors['password_error'] = "Te rugam sa introduci parola.";
    } else if (strlen($data['password']) < 6) {
        $errors['password_error'] = "Parola trebuie sa contina minim 6 caractere.";
    }

    // validam confirmarea parolei
    if (empty($data['password_confirmation'])) {
        $errors['password_conf_error'] = "Introdu parola din nou pentru a o confirma.";
    } else if (strlen($data['password_confirmation']) < 6) {
        $errors['password_conf_error'] = "Parola trebuie sa contina minim 6 caractere.";
    } else if (strcasecmp($data['password'], $data['password_confirmation']) != 0) {
        $errors['password_conf_error'] = "Parolele nu coincid.";
    }

    // validam captcha
    if (empty($data['captcha'])) {
        $errors['captcha_error'] = "Te rugam sa raspunzi la intrebare.";
    } else if($data['captcha'] != $data['captcha_verify']) {
        $errors['captcha_error'] = "Raspunsul introdus este gresit.";
    }

    return $errors;
}

function validateLogin($data, $userCheck)
{
    $errors = [
        'username_error' => '',
        'password_error' => ''
    ];

    // validam username-ul
    if (empty($data['username'])) {
        $errors['username_error'] = "Username-ul nu poate fi gol.";
    } else if (strlen($data['username']) < 3) {
        $errors['username_error'] = "Username-ul trebuie sa contina minim 3 caractere.";
    } else if ($userCheck == false) {
        $errors['username_error'] = "Nu am gasit niciun utilizator cu acest username.";
    }

    // validam parola
    if (empty($data['password'])) {
        $errors['password_error'] = "Te rugam sa introduci parola.";
    } else if (strlen($data['password']) < 6) {
        $errors['password_error'] = "Parola trebuie sa contina minim 6 caractere.";
    } else if (!password_verify($data['password'], $userCheck['password'])) {
        $errors['password_error'] = "Parola introdusa este incorecta.";
    }

    // validam captcha
    if (empty($data['captcha'])) {
        $errors['captcha_error'] = "Te rugam sa raspunzi la intrebare.";
    } else if($data['captcha'] != $data['captcha_verify']) {
        $errors['captcha_error'] = "Raspunsul introdus este gresit.";
    }

    return $errors;
}