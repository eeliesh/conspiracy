<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">Conspiracy Network</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . '/posts.php'; ?>"><i class="fas fa-comments"></i> Postări</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_URL . '/about.php'; ?>" class="nav-link"><i class="fas fa-question-circle"></i> Despre Noi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL . '/contact.php'; ?>"><i class="fas fa-info-circle"></i> Contact</a>
                </li>
                <?php if (isLoggedIn()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . '/logout.php'; ?>"><i class="fas fa-sign-out-alt"></i> Delogare</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . '/login.php'; ?>"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL . '/register.php'; ?>"><i class="fas fa-user-plus"></i> Înregistrare</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>