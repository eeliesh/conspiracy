<?php
include_once 'init.php';
$pageData = [
    'pageTitle' => 'Despre Noi',
    'description' => 'Află mai multe despre Conspiracy Network',
    'image' => BASE_URL . '/resources/img/about-bg.jpg'
];
getHeader($pageData);
flashMessage();
?>
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <iframe width="100%" height="400" src="https://www.youtube.com/embed/bILpyE--I_I" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        <p>Suntem un site ce nu publică orice știre apărută pe internet. Principalul nostru scop este de a prezenta
            întregii lumi cele mai importante teorii conspiraționale. Considerăm că acesta a fost și va fi mereu un
            subiect actual.</p>
        <p>Lucrăm zi de zi pentru a posta noi articole și pentru a vă ține mereu la curent. Nimic nu este inventat de
            noi, ci preluat din surse sigure.</p>
        <p></p>
    </div>
</div>
<?php getFooter(); ?>
