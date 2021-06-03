<?php
include_once '../init.php';
if (!isLoggedIn()) {
    flashMessage('danger', 'Trebuie sa te autentifici pentru a putea posta.');
    redirect('/');
} else {
    if (isset($_POST['create_post'])) {
        $posts->createPost($_POST);
    }
    $firstNumber = rand(1, 9);
    $secondNumber = rand(1, 9);
    $captchaResult = $firstNumber + $secondNumber;
    $pageData = [
        'pageTitle' => 'Postare nouă',
        'description' => 'Publică o știre care va da oamenilor lumea peste cap'
    ];
    getHeader($pageData);
    flashMessage();
    ?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h3 class="page-title mb-4">Postare Nouă</h3>
            <form method="post" class="cn-form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Titlu</label>
                    <input type="text" class="form-control<?php if (!empty($posts->errors['title_error'])): ?> is-invalid<?php endif;?>" id="title" name="title" value="<?php echo $posts->postData['title']; ?>">
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
                    <label for="body">Conținut</label>
                    <textarea name="post_body" id="body" rows="5" class="form-control<?php if (!empty($posts->errors['body_error'])): ?> is-invalid<?php endif; ?>"><?php echo $posts->postData['body']; ?></textarea>
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
                <button type="submit" id="create_post" class="btn btn-primary" name="create_post">Postează</button>
            </form>
        </div>
    </div>
    <?php getFooter();
} ?>
