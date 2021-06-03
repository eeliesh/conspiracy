<?php
include_once ROOT_PATH . '/helpers/validate_post.php';

class Posts extends Db
{
    public $errors = array();
    public $postData = [
        'title' => '',
        'body' => ''
    ];

    public function createPost($data)
    {
        // scapam de elementele nedorite din input
        $data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
        $data['post_body'] = str_replace(PHP_EOL, '<br>', $data['post_body']);
        $data['post_body'] = htmlentities($data['post_body']);

        // adaugam imaginea si id-ul utilizatorului in post data
        $data['featured_image'] = $_FILES['image']['name'];
        $data['author_id'] = $_SESSION['user_id'];
        $fileTarget = ROOT_PATH . '/uploads/' . basename($_FILES['image']['name']);

        // adaugam file target in data
        $data['target_file'] = $fileTarget;

        // validam input-urile
        $this->errors = validatePost($data);

        // verificam daca nu sunt erori
        if (count(array_filter($this->errors)) == 0) {
            // adaugam postarea in baza de date
            if ($this->insertPost($data)) {
                // incarcam fisierul din postare
                if (move_uploaded_file($_FILES['image']['tmp_name'], $fileTarget)) {
                    // adaugare mesaj flash in sesiune si redirectionare pe pagina postarilor
                    flashMessage('success', 'Postarea a fost publicata cu succes.');
                    redirect('/posts.php');
                }
            } else {
                die('A aparut o eroare. Te rugam sa incerci din nou.');
            }
        } else {
            // in caz ca sunt erori, salvam datele trimise anterior pentru a le afisa in input
            $this->postData['title'] = $_POST['title'];
            $this->postData['body'] = $_POST['post_body'];
        }
    }

    public function editPost($data, $id)
    {
        // stergem elementele nedorite din input
        $data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);

        // scapam de entitatile html ale textului pentru a stoca informatia in baza de date
        $data['post_body'] = str_replace(PHP_EOL, '<br>', $data['post_body']);
        $data['post_body'] = htmlentities($data['post_body']);
        $data['id'] = $id;

        // adaugam imaginea in post data
        $data['featured_image'] = $_FILES['image']['name'];
        $fileTarget = ROOT_PATH . '/uploads/' . basename($_FILES['image']['name']);

        // adaugam file target in data
        $data['target_file'] = $fileTarget;

        // validam input-urile
        $this->errors = validatePost($data);

        // verificam daca nu sunt erori
        if (count(array_filter($this->errors)) == 0) {
            // editam postarea in baza de date
            if ($this->updatePost($data)) {
                // incarcam fisierul din postare
                if (move_uploaded_file($_FILES['image']['tmp_name'], $fileTarget)) {
                    // adaugam mesaj flash in  sesiune si redirectionam pe pagina cu postarea
                    flashMessage('success', 'Postarea a fost editata cu succes.');
                    redirect('/post/view.php?id=' . $id);
                }
            } else {
                die('A aparut o eroare. Incearca din nou.');
            }
        }
    }

    public function deletePost($id)
    {
        // stergem postarea
        if ($this->deletePostDb($id)) {
            // adaugam mesaj flash in sesiune si redirectionam pe pagina postarilor
            flashMessage('success', 'Postarea a fost stearsa cu succes.');
            redirect('/posts.php');
        } else {
            die('A aparut o eroare. Incearca din nou.');
        }
    }

    public function allPosts()
    {
        // salvam toate postarile
        $allPosts = $this->getAllPosts();
        $finalPosts = array();
        // convertim descrierea postarii in cod html
        if (!empty($allPosts)) {
            foreach ($allPosts as $post) {
                $post['body'] = html_entity_decode($post['body']);
                $post['body'] = str_replace('<br>', PHP_EOL, $post['body']);
                array_push($finalPosts, $post);
            }
        }
        // returnam rezultele
        return $finalPosts;
    }

    public function latestPosts()
    {
        // salvam toate postarile
        $latestPosts = $this->getLatestPosts();
        $finalPosts = array();
        // convertim descrierea postarii in cod html
        if (!empty($latestPosts)) {
            foreach ($latestPosts as $post) {
                $post['body'] = html_entity_decode($post['body']);
                $post['body'] = str_replace('<br>', PHP_EOL, $post['body']);
                array_push($finalPosts, $post);
            }
        }
        // returnam rezultele
        return $finalPosts;
    }

    public function singlePost($id)
    {
        // salvam postarea
        $singlePost = $this->getPost($id);
        // convertim descrierea postarii in cod html
        if (!empty($singlePost)) {
            $singlePost['body'] = html_entity_decode($singlePost['body']);
        }
        // returnam postarea
        return $singlePost;
    }

    public function searchPost($key)
    {
        return $this->searchPostDb($key);
    }
}