<?php
// Incarcam header-ul paginii
function getHeader($pageData)
{
    include_once ROOT_PATH . '/includes/layouts/header.php';
}

// Incarcam footer-ul paginii
function getFooter()
{
    include_once ROOT_PATH . '/includes/layouts/footer.php';
}

// Incarcam meniul paginii
function getMenu()
{
    include_once ROOT_PATH . '/includes/layouts/menu.php';
}

// Facem redirect pe o anumita pagina
function redirect($page)
{
    header('location: ' . BASE_URL . $page);
    exit;
}

// Adaugam un mesaj flash temporar
function flashMessage($type = '', $message = '')
{
    // create a new session message
    if (!empty($type) && !empty($message)) {
        // set session message and its type
        $_SESSION['message_type'] = $type;
        $_SESSION['message'] = $message;
    } else if (isset($_SESSION['message_type']) && isset($_SESSION['message'])) {
        // display the message
        echo '<div class="dv-message ' . $_SESSION['message_type'] . '"><i class="fas fa-info-circle"></i><span>' . $_SESSION['message'] . '</div>';
        // unset session message
        unset($_SESSION['message_type'], $_SESSION['message']);
    }
}

// Verificam daca utilizatorul este logat
function isLoggedIn()
{
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
        return true;
    } else {
        return false;
    }
}

// Verificam daca utilizatorul este admin
function isAdmin($role)
{
    if (strcasecmp($role, 'Admin') == 0) {
        return true;
    } else {
        return false;
    }
}