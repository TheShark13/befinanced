<?php

use App\Model\LandingPageJsFile;
use AssetsLoader\AssetsLoaderDecider;
use AssetsLoader\ScriptsLoaderStrategy;
use AssetsLoader\StylesLoaderStrategy;
use App\Model\LandingPageCssFile;

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#3ed2a7">

    <link rel="shortcut icon" href="./favicon.png" />

    <title>Ave HTML Template</title>

    <?=
    AssetsLoaderDecider::loadAssets([
        new LandingPageCssFile("liquid-icon.min.css"),
        new LandingPageCssFile("font-awesome.min.css"),
        new LandingPageCssFile("theme-vendors.min.css"),
        new LandingPageCssFile("theme.min.css"),
        new LandingPageCssFile("opus.css")
    ], new StylesLoaderStrategy())

    ?>

    <!-- Head Libs -->
    <script async src="landing_page/js/modernizr.min.js"></script>

</head>
<body class="error404" data-mobile-nav-trigger-alignment="right" data-mobile-nav-align="left" data-mobile-nav-style="modern" data-mobile-nav-shceme="gray" data-mobile-header-scheme="gray" data-mobile-nav-breakpoint="1199">

<div id="wrap">

    <main id="content" class="content">

        <section class="vc_row page-404 error-404 not-found fullheight">

            <div class="container">

                <div class="row">

                    <div class="col-md-8 col-md-offset-2 text-center">

                        <div class="text-404">

                            <div class="ld-particles-container">

                                <div
                                        class="re-particles-inner"
                                        id="particles-404-1"
                                        data-particles="true"
                                        data-particles-options='{ "particles": { "number": { "value": 15 }, "opacity": { "random": true, "anim": { "enable": true, "opacity_min": 0.7 } }, "size": { "value": 30, "anim": { "enable": true, "speed": 1, "size_min": 0.7 } }, "move": { "direction": "top-right", "speed": 2 } }, "interactivity": {} }'>
                                </div><!-- /.re-particles-inner -->

                            </div><!-- /.ld-particles-container -->

                            <h1 data-fittext="true" data-fittext-options='{ "compressor": 0.25, "minFontSize": 150, "maxFontSize": 300 }' class="liquid-counter-element" data-enable-counter="true" data-counter-options='{ "targetNumber": "404", "blurEffect": true }'>
                                <span>000</span>
                            </h1><!-- /.liquid-counter-element -->

                            <div class="ld-particles-container">

                                <div
                                        class="re-particles-inner"
                                        id="particles-404-2"
                                        data-particles="true"
                                        data-particles-options='{ "particles": { "number": { "value": 15 }, "opacity": { "random": true, "anim": { "enable": true, "opacity_min": 0.7 } }, "size": { "value": 30, "anim": { "enable": true, "speed": 1, "size_min": 0.7 } }, "move": { "direction": "top-left", "speed": 2 } }, "interactivity": {} }'>
                                </div><!-- /.re-particles-inner -->

                            </div><!-- /.ld-particles-container -->

                        </div><!-- /.text-404 -->

                        <h3 class="font-weight-bold mb-1">Finantarea ta nu se afla aici :(</h3>
                        <p class="mb-5">Pagina pe care ai incercat sa o accesezi nu exista in cadrul platformei noastre.</p>

                        <a href="/" class="btn btn-md btn-solid btn-gradient circle btn-icon-left font-weight-bold text-uppercase ltr-sp-1 wide">
								<span>
									<span class="btn-gradient-bg"></span>
									<span class="btn-txt">Intoarce-te pe prima pagina</span>
									<span class="btn-gradient-bg btn-gradient-bg-hover"></span>
								</span>
                        </a>

                    </div><!-- /.col-md-8 -->

                </div><!-- /.row -->

            </div> <!-- /.container -->

        </section>

    </main><!-- /#content.content -->

</div><!-- /#wrap -->

<?=
AssetsLoaderDecider::loadAssets([
    new LandingPageJsFile("jquery.min.js"),
    new LandingPageJsFile("theme-vendors.js"),
    new LandingPageJsFile("theme.min.js"),
], new ScriptsLoaderStrategy())

?>

</body>
</html>