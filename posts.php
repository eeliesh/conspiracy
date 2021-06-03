<?php
include_once 'init.php';
$pageData = [
    'pageTitle' => 'Toate Postările',
    'description' => 'Nu rata nicio postare nouă'
];
getHeader($pageData);
flashMessage();
if (isset($_POST['search-post'])) {
    $searchResults = $posts->searchPost($_POST['search_key']);
}
?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <form action="posts.php" class="cn-form" method="post">
                <div class="form-group">
                    <label for="search"></label>
                    <input type="text" name="search_key" id="search" class="form-control" placeholder="Caută o postare...">
                </div>
                <div class="text-right">
                    <button type="submit" name="search-post" class="btn btn-primary mb-5">Caută</button>
                </div>
            </form>
            <?php if (isset($_POST['search-post'])): ?>
                <?php if (empty($searchResults)): ?>
                    <h3 class="text-center mb-5">Nu a fost găsită nicio postare.</h3>
                <?php else: ?>
                    <?php foreach ($searchResults as $post): ?>
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
                <?php endif; ?>
            <?php else: ?>
                <?php if (isLoggedIn()): ?>
                    <div class="clearfix">
                        <a href="<?php echo BASE_URL . '/post/create.php'; ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i> Postare Nouă</a>
                    </div>
                <?php endif; ?>
                <?php foreach ($posts->allPosts() as $post): ?>
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
            <?php endif; ?>
        </div>
    </div>
<?php getFooter(); ?>