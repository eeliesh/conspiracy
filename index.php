<?php
include_once 'init.php';
$pageData = [
    'description' => 'Îți prezentăm cele mai importante teorii conspiraționale'
];
getHeader($pageData);
flashMessage();
?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="home-song mb-4">
                <audio controls autoplay>
                    <source src="<?php echo BASE_URL . '/resources/songs/conspiracy-theme.mp3'; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <h2 class="page-title mb-4">Ultimele postări</h2>
            <?php foreach ($posts->latestPosts() as $post): ?>
                <div class="post-preview">
                    <a href="<?php echo BASE_URL . '/post/view.php?id=' . $post['id']; ?>">
                        <h2 class="post-title"><?php echo $post['title']; ?></h2>
                        <h3 class="post-subtitle"><?php echo substr($post['body'], 0, 70) . '...'; ?></h3>
                    </a>
                    <p class="post-meta">Postat de
                        <strong><?php echo $users->getUserInfo($post['author_id'])['username']; ?></strong>
                        pe <?php echo $post['created_at']; ?>
                    </p>
                </div>
            <?php endforeach; ?>
            <hr>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="<?php echo BASE_URL . '/posts.php'; ?>">Toate postările &rarr;</a>
            </div>
        </div>
    </div>
<?php getFooter(); ?>