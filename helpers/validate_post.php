<?php
function validatePost($data)
{
    $errors = [
        'title_error' => '',
        'image_error' => '',
        'body_error' => '',
        'captcha_error' => ''
    ];

    // validam titlul
    if (empty($data['title'])) {
        $errors['title_error'] = "Te rugam sa introduci titlul.";
    } else if (strlen($data['title']) < 5) {
        $errors['title_error'] = "Titlul trebuie sa contina minim 5 caractere.";
    }

    // validam imaginea
    if (file_exists($data['target_file'])) {
        $errors['image_error'] = "O imagine cu acest nume exista deja.";
    }

    // validam continutul
    if (empty($data['post_body'])) {
        $errors['body_error'] = "Descrierea postarii nu poate fi goala.";
    } else if (strlen($data['post_body']) < 20) {
        $errors['body_error'] = "Descrierea trebuie sa contina minim 20 de caractere.";
    }

    // validam captcha
    if (empty($data['captcha'])) {
        $errors['captcha_error'] = "Te rugam sa raspunzi la intrebare.";
    } else if($data['captcha'] != $data['captcha_verify']) {
        $errors['captcha_error'] = "Raspunsul introdus este gresit.";
    }

    return $errors;
}