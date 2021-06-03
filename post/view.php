<?php
include_once '../init.php';
if (!isset($_GET['id'])) {
    flashMessage('danger', 'Pagina nu a fost gasita.');
    redirect('/');
} else {
    $post_id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['id']);
    $post = $posts->singlePost($post_id);
    $pageData = [
        'pageTitle' => $post['title'],
        'postInfo' => $post,
        'author_name' => $users->getUserInfo($post['author_id'])['username'],
        'image' => BASE_URL . '/uploads/' . $post['image']
    ];
    if (isLoggedIn()) {
        $userRole = $users->getUserInfo($_SESSION['user_id'])['role'];
    }
    if (isLoggedIn() && isAdmin($userRole)) {
        if (isset($_GET['delete']) && $post_id == $_GET['delete']) {
            $posts->deletePost($_GET['delete']);
        }
    }
    getHeader($pageData);
    flashMessage();
    ?>
    <article>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?php if (isLoggedIn() && isAdmin($userRole)): ?>
                    <div class="mb-4">
                        <a href="<?php echo BASE_URL . '/post/edit.php?id=' . $post['id']; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editează</a>
                        <a href="<?php echo BASE_URL . '/post/view.php?id=' . $post['id'] . '&delete=' . $post['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Șterge</a>
                    </div>
                <?php endif; ?>
                <?php echo $post['body']; ?>
            </div>
        </div>
    </article>
    <?php getFooter();
} ?>
