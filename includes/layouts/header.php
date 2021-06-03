<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo isset($pageData['pageTitle']) ? $pageData['pageTitle'] : SITE_NAME; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL . '/favicon.ico'; ?>"/>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/resources/3rd_party/bootstrap/css/bootstrap.min.css'; ?>">
    <!-- Custom fonts -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/resources/3rd_party/fontawesome-free/css/all.min.css'; ?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>
    <!-- Custom css -->
    <link href="<?php echo BASE_URL . '/resources/css/main.css'; ?>" rel="stylesheet">
</head>
<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
<?php getMenu(); ?>
<!-- Page Header -->
<header class="masthead"
        style="background-image: url(<?php if (isset($pageData['image'])): echo $pageData['image']; else: echo BASE_URL . '/resources/img/home-bg.jpg'; endif; ?>)">
    <canvas id="cn-canvas"></canvas>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <?php if (isset($pageData['postInfo'])): ?>
                    <div class="post-heading">
                        <h1><?php echo $pageData['postInfo']['title']; ?></h1>
                        <span class="meta">Postat de
                            <strong><?php echo $pageData['author_name']; ?></strong>
                            pe <?php echo $pageData['postInfo']['created_at']; ?>
                            </span>
                    </div>
                <?php else: ?>
                    <div class="site-heading">
                        <?php if (isset($pageData['pageTitle'])): ?>
                            <h1><?php echo $pageData['pageTitle']; ?></h1>
                        <?php else: ?>
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 575 115" style="enable-background:new 0 0 575 115;" xml:space="preserve">
                                    <g>
                                        <path d="M90.1,79C87,97.4,74.7,114.8,47,114.8c-34.2,0-46.8-25.3-46.8-57.6c0-30.7,15.5-56.9,47.7-56.9c28.5,0,40.2,18,41.7,35.7
                                            H70.2c-2.4-10.5-7.3-19.8-23-19.8c-19.7,0-26.8,19.7-26.8,40.9c0,21.9,6.3,41.8,27,41.8c15.4,0,20.7-10.1,23.3-19.9H90.1z"/>
                                        <path d="M107,113V2h25.4c37.1,71.9,42.7,82.8,44.5,88h0.3c-1.8-22.7-1.1-62.6-1.3-88h18v111h-23.7c0,0-43.4-86.1-45.3-91h-0.2
                                            c1.2,23.2,1.2,64.5,1.2,91H107z"/>
                                        <path d="M222.1,74c0,18.2,3.3,33.1,17.2,33.1c14.1,0,16-13.7,16.4-16.1h9.1c-0.2,1.9-2.7,24.2-25.6,24.2c-23.2,0-26.4-22-26.4-42.3
                                            c0-25.9,8.5-42.4,27.2-42.4c22.9-0.3,26.5,22.8,25.3,43.5H222.1z M256.3,66c0-16.3-3.8-27.6-16.4-27.6c-16.5,0-17.3,22.2-17.5,27.6
                                            H256.3z"/>
                                        <path d="M273,32h12V10h9v22h14v8h-15v56.9c-0.3,10.5,5.7,10.4,14,9.3v7.3c-2.5,0.9-6.3,1.3-9,1.3c-8.4,0-14-3.6-14-15.9V40h-11V32z
                                            "/>
                                        <path d="M324.3,32c8.6,39.7,13,59.6,14.6,71h0.2c1.7-10.5,5-23.5,16.2-71h9.1c10.9,47.6,14.2,62.3,15.5,71h0.2
                                            c1.3-9.1,4.9-24.9,15.2-71h9.5l-20.1,82h-9.9c-6.3-27.5-13.2-57-15.1-70h-0.2c-1.6,12.5-8,38-15.7,70h-10.3l-18.9-82H324.3z"/>
                                        <path d="M466.9,71.6c0,28.3-9.2,43.3-27,43.3c-18.5,0-27.2-14.5-27.2-43.1c0-28.1,10.6-41.3,27.5-41.3
                                            C457.4,30.6,466.9,44.2,466.9,71.6z M422.1,72c0,24,6.5,34.9,17.7,34.9c11.4,0,17.6-11.2,17.6-35.1c0-21.9-6-33-17.7-33
                                            C428.8,38.7,422.1,48.1,422.1,72z"/>
                                        <path d="M483,60c0-12.9,0-22.1-0.2-28h8.7c0.2,2.4,0.4,6.3,0.4,15c3.7-10.1,12-16,22.1-16.2v9.9c-14.6,0.7-22,11.4-22,26.2v47h-9
                                            V60z"/>
                                        <path d="M534,71.9c5-7.1,21.1-29,28.6-39.9h10.1c-7.5,10.5-15.8,21.4-23.5,31.8c0,0,26.2,50.2,26.2,50.2h-10.4
                                            c0,0-21.8-42.9-21.8-42.9c-2.4,3-6.8,9-9.3,12.1V114h-9V-2h9V71.9z"/>
                                    </g>
                                </svg>
                        <?php endif; ?>
                        <span class="subheading"><?php echo $pageData['description']; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<div class="container">
