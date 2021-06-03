<?php
include_once 'init.php';
if (isLoggedIn()) {
    flashMessage('danger', 'Esti deja autentificat.');
    redirect('/');
} else {
    if (isset($_POST['register_user'])) {
        $users->registerUser($_POST);
    }
    $firstNumber = rand(1, 9);
    $secondNumber = rand(1, 9);
    $captchaResult = $firstNumber + $secondNumber;
    $pageData = [
        'pageTitle' => 'Înregistrare',
        'description' => ''
    ];
    getHeader($pageData); ?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h3 class="page-title mb-4"><i class="fas fa-user-plus"></i> Register</h3>
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
                    <label for="email">Email</label>
                    <input type="email"
                           class="form-control<?php if (!empty($users->errors['email_error'])): ?> is-invalid<?php endif; ?>"
                           id="email" name="email" value="<?php echo $users->postData['email']; ?>">
                    <?php if (!empty($users->errors['email_error'])): ?>
                        <div class="invalid-feedback"><?php echo $users->errors['email_error']; ?></div>
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
                    <label for="passwordConfirmation">Confirm Password</label>
                    <input type="password"
                           class="form-control <?php if (!empty($users->errors['password_conf_error'])): ?> is-invalid<?php endif; ?>"
                           id="password" name="password_confirmation">
                    <?php if (!empty($users->errors['password_conf_error'])): ?>
                        <div class="invalid-feedback"><?php echo $users->errors['password_conf_error']; ?></div>
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
                <button type="submit" class="btn btn-primary" name="register_user">Register</button>
            </form>
        </div>
    </div>
    <?php getFooter();
} ?>
