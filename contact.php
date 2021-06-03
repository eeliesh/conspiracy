<?php
include_once 'init.php';
$pageData = [
    'pageTitle' => 'Contact',
    'description' => 'Află datele noastre de contact',
    'image' => BASE_URL . '/resources/img/contact-bg.jpg'
];
getHeader($pageData);
flashMessage();
?>
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <p class="text-center">Vrei să iei legătura cu noi? Găsești mai jos adresele noastre de contact!</p>
        <ul class="list-inline text-center">
            <li class="list-inline-item mb-4">
                <a href="https://twitter.com/iUnexplained" target="_blank">
                    <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://www.facebook.com/Conspiratii-754046174943086/" target="_blank">
                    <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </li>
            <li class="list-inline-item">
                <a href="https://www.youtube.com/channel/UCJEzKhaw_jWOqQe146sY5TA" target="_blank">
                    <span class="fa-stack fa-lg">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-youtube fa-stack-1x fa-inverse"></i>
                    </span>
                </a>
            </li>
        </ul>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2712.1773147592944!2d27.569917615876236!3d47.173964825756265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sAlexandru%20Ioan%20Cuza%20University!5e0!3m2!1sen!2s!4v1586967129188!5m2!1sen!2s"
                width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe>
    </div>
</div>
<?php getFooter(); ?>
