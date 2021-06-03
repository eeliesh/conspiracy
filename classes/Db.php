<?php
class Db
{
    private $dbHost = DB_HOST;
    private $dbName = DB_NAME;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;

    protected function connect()
    {
        $dsn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName . ';charset=utf8';
        $pdo = new PDO($dsn, $this->dbUser, $this->dbPass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

    protected function insertPost($data)
    {
        // pregatim query
        $sql = "INSERT INTO `posts` (`title`, `body`, `image`, `author_id`) VALUES (:title, :body, :image, :author_id)";
        $stmt = $this->connect()->prepare($sql);
        // inseram valorile variabilelor in query
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':body', $data['post_body']);
        $stmt->bindValue(':image', $data['featured_image']);
        $stmt->bindValue(':author_id', $data['author_id']);
        // executam query-ul
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    protected function getAllPosts()
    {
        // executam query
        $sql = "SELECT * FROM `posts` ORDER BY `created_at` DESC";
        $stmt = $this->connect()->query($sql);
        // returnam rezultatele
        return $stmt->fetchAll();
    }

    protected function getLatestPosts()
    {
        // executam query
        $sql = "SELECT * FROM `posts` ORDER BY `created_at` DESC LIMIT 4";
        $stmt = $this->connect()->query($sql);
        // returnam rezultatele
        return $stmt->fetchAll();
    }

    protected function getPost($id)
    {
        // pregatim query
        $sql = "SELECT * FROM `posts` WHERE `id`=:id";
        $stmt = $this->connect()->prepare($sql);
        // inseram variabila in query
        $stmt->bindValue(':id', $id);
        // executam query-ul
        $stmt->execute();
        // returnam rezultatul
        return $stmt->fetch();
    }

    protected function updatePost($data)
    {
        // pregatim query
        $sql = "UPDATE `posts` SET `title`=:title, `body`=:body, `image`=:image WHERE `id`=:id";
        $stmt = $this->connect()->prepare($sql);
        // inseram variabilele in query
        $stmt->bindValue(':title', $data['title']);
        $stmt->bindValue(':body', $data['post_body']);
        $stmt->bindValue(':image', $data['featured_image']);
        $stmt->bindValue(':id', $data['id']);
        // executam query-ul
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    protected function deletePostDb($id)
    {
        // pregatim query
        $sql = "DELETE FROM `posts` WHERE `id`=:id";
        $stmt = $this->connect()->prepare($sql);
        // inseram variabila in query
        $stmt->bindValue(':id', $id);
        // executam query-ul
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    protected function searchExistingUser($username, $email)
    {
        // pregatim query
        $sql = "SELECT * FROM `users` WHERE `username`=:username OR `email`=:email";
        $stmt = $this->connect()->prepare($sql);
        // inseram valorile variabilelor in query
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        // executam query-ul
        $stmt->execute();
        // returnam rezultatul
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    protected function getUserByName($username)
    {
        // pregatim query
        $sql = "SELECT * FROM `users` WHERE `username`=:username";
        $stmt = $this->connect()->prepare($sql);
        // inseram variabila in query
        $stmt->bindValue(':username', $username);
        // executam query-ul
        $stmt->execute();
        // returnam rezultatul
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return false;
        }
    }

    protected function getUserById($id)
    {
        // pregatim query
        $sql = "SELECT * FROM `users` WHERE `id`=:id";
        $stmt = $this->connect()->prepare($sql);
        // inseram variabila in query
        $stmt->bindValue(':id', $id);
        // executam query-ul
        $stmt->execute();
        // returnam rezultatul
        return $stmt->fetch();
    }

    protected function setUser($data)
    {
        // pregatim query
        $sql = "INSERT INTO `users` (`username`, `email`, `ip_address`, `role`, `password`) VALUES (:username, :email, :ip_address, :role, :password)";
        $stmt = $this->connect()->prepare($sql);
        // inseram valorile variabilelor in query
        $stmt->bindValue(':username', $data['username']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':ip_address', $data['ip_address']);
        $stmt->bindValue('role', $data['role']);
        $stmt->bindValue(':password', $data['password']);
        // executam query-ul
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    protected function searchPostDb($key)
    {
        // cautam toate postarile
        $results = $this->getAllPosts();
        $finalResults = array();
        // verificam daca sunt rezultate
        if (!empty($results)) {
            foreach ($results as $result) {
                // impartim titlul intr-un array
                $result['title'] = str_replace(',', '', $result['title']);
                $result['title_arr'] = explode(' ', $result['title']);
                if (in_array($key, $result['title_arr'])) {
                    array_push($finalResults, $result);
                }
            }
        }
        // returnam rezultatul
        return $finalResults;
    }
}