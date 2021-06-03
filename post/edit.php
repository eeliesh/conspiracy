<?php
include_once '../init.php';
if (!isset($_GET['id'])) {
    flashMessage('danger', 'Pagina nu a fost gasita.');
    redirect('/');
} else if (!isLoggedIn()) {
    flashMessage('danger', 'Trebuie sa te autentifici intai.');
    redirect('/');
} else if (!isAdmin($users->getUserInfo($_SESSION['user_id'])['role'])) {
    flashMessage('danger', 'Nu ai acces la aceasta pagina.');
    redirect('/');
} else {
    $post_id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['id']);
    $post = $posts->singlePost($post_id);
    $post['body'] = html_entity_decode($post['body']);
    $post['body'] = str_replace('<br>', PHP_EOL, $post['body']);
    $firstNumber = rand(1, 9);
    $secondNumber = rand(1, 9);
    $captchaResult = $firstNumber + $secondNumber;
    $pageData = [
        'pageTitle' => 'Editeaza postare',
        'description' => ''
    ];
    if (isset($_POST['edit_post'])) {
        $posts->editPost($_POST, $post_id);
    }
    getHeader($pageData);
    flashMessage();
    ?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h3 class="page-title mb-4">Editeaza Postare</h3>
            <form method="post" class="cn-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Titlu</label>
                    <input type="text" class="form-control<?php if (!empty($posts->errors['title_error'])): ?> is-invalid<?php endif;?>" id="title" name="title" value="<?php echo $post['title']; ?>">
                    <?php if (!empty($posts->errors['title_error'])): ?>
                        <div class="invalid-feedback"><?php echo $posts->errors['title_error']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="featuredImage">Imagine default</label>
                    <input type="file" name="image" id="featuredImage" class="form-control<?php if (!empty($posts->errors['image_error'])): ?> is-invalid<?php endif; ?>">
                    <?php if (!empty($posts->errors['image_error'])): ?>
                        <div class="invalid-feedback"><?php echo $posts->errors['image_error']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="body">Continut</label>
                    <textarea name="post_body" id="body" rows="5" class="form-control<?php if (!empty($posts->errors['body_error'])): ?> is-invalid<?php endif; ?>"><?php echo $post['body']; ?></textarea>
                    <?php if (!empty($posts->errors['body_error'])): ?>
                        <div class="invalid-feedback"><?php echo $posts->errors['body_error']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="captcha"><?php echo $firstNumber . '+' . $secondNumber . '=?'; ?></label>
                    <input type="hidden" name="captcha_verify" value="<?php echo $captchaResult; ?>">
                    <input type="number" class="form-control<?php if (!empty($posts->errors['captcha_error'])): ?> is-invalid<?php endif; ?>" id="captcha" name="captcha">
                    <?php if (!empty($posts->errors['captcha_error'])): ?>
                        <div class="invalid-feedback"><?php echo $posts->errors['captcha_error']; ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" id="create_post" class="btn btn-primary" name="edit_post">Posteaza</button>
            </form>
        </div>
    </div>
    <?php getFooter();
} ?>
