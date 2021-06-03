<?php
include_once 'init.php';
if (isLoggedIn()) {
    flashMessage('danger', 'Esti deja autentificat.');
    redirect('/');
} else {
    if (isset($_POST['login_user'])) {
        $users->loginUser($_POST);
    }
    $firstNumber = rand(1, 9);
    $secondNumber = rand(1, 9);
    $captchaResult = $firstNumber + $secondNumber;
    $pageData = [
        'pageTitle' => 'Autentificare',
        'description' => ''
    ];
    getHeader($pageData);
    flashMessage();
    ?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h3 class="page-title mb-4"><i class="fas fa-sign-in-alt"></i> Login</h3>
            <form action="" method="post" class="cn-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text"
                           class="form-control<?php if (!empty($users->errors['username_error'])): ?> is-invalid<?php endif; ?>"
                           id="username" name="username" value="<?php echo $users->postData['username']; ?>">
                    <?php if (!empty($users->errors['username_error'])): ?>
                        <div class="invalid-feedback"><?php echo $users->errors['username_error']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           class="form-control<?php if (!empty($users->errors['password_error'])): ?> is-invalid<?php endif; ?>"
                           id="password" name="password">
                    <?php if (!empty($users->errors['password_error'])): ?>
                        <div class="invalid-feedback"><?php echo $users->errors['password_error']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="captcha"><?php echo $firstNumber . '+' . $secondNumber . '=?'; ?></label>
                    <input type="hidden" name="captcha_verify" value="<?php echo $captchaResult; ?>">
                    <input type="number" class="form-control<?php if (!empty($users->errors['captcha_error'])): ?> is-invalid<?php endif; ?>" id="captcha" name="captcha">
                    <?php if (!empty($users->errors['captcha_error'])): ?>
                        <div class="invalid-feedback"><?php echo $users->errors['captcha_error']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember_me">
                    <label class="form-check-label" for="rememberMe">Nu ma uita</label>
                </div>
                <button type="submit" class="btn btn-primary" name="login_user">Login</button>
            </form>
        </div>
    </div>
    <?php getFooter();
} ?>