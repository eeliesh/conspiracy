<?php
include_once ROOT_PATH . '/helpers/validate_auth.php';

class Users extends Db
{
    public $errors = array();
    public $postData = [
        'username' => '',
        'email' => ''
    ];

    public function registerUser($data)
    {
        // scapam de elementele nedorite din input
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // adaugam ip-ul utilizatorului si rolul default
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'];
        $data['role'] = 'Member';

        // salvam intr-o variabila informatia daca exista un utilizator sau nu
        $userCheck = $this->searchExistingUser($data['username'], $data['email']);

        // validam input-urile
        $this->errors = validateRegister($data, $userCheck);

        // verificam daca nu sunt erori
        if (count(array_filter($this->errors)) == 0) {
            // transformam parola in hash
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            // inregistram utilizatorul
            if ($this->setUser($data)) {
                // adaugam un mesaj in sesiune si redirectionam pe pagina de login
                flashMessage('success', 'Felicitari! Ai fost inregistrat cu succes si acum te poti autentifica.');
                redirect('/login.php');
            } else {
                die('A aparut o problema. Incearca din nou.');
            }
        } else {
            // salvam informatia din input
            $this->postData['username'] = $data['username'];
            $this->postData['email'] = $data['email'];
        }
    }

    public function loginUser($data)
    {
        // scapam de elemente nedorite din input
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // verificam daca exista utilizatorul
        $userCheck = $this->getUserByName($data['username']);

        // validam input-urile
        $this->errors = validateLogin($data, $userCheck);

        // verificam daca nu sunt erori
        if (count(array_filter($this->errors)) == 0) {
            // autentificam utilizatorul
            $_SESSION['user_id'] = $userCheck['id'];
            $_SESSION['user_name'] = $userCheck['username'];
            // setam un cookie daca a fost selectat butonul 'nu ma uita'
            if (!empty($data['remember_me'])) {
                setcookie('user_id', $userCheck['id'], time() + (86400 * 30), "/");
                setcookie('user_name', $userCheck['username'], time() + (86400 * 30), "/");
            }
            // adaugam un mesaj in sesiune si redirectionam pe pagina principala
            flashMessage('success', 'Ai fost autentificat cu succes.');
            redirect('/');
        } else {
            // salvam informatia din input
            $this->postData['username'] = $data['username'];
        }
    }

    public function getUserInfo($user_id)
    {
        return $this->getUserById($user_id);
    }
}