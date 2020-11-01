<?php

use App\Model\LandingPageJsFile;
use AssetsLoader\AssetsLoaderDecider;
use AssetsLoader\ScriptsLoaderStrategy;

?>
<?=
AssetsLoaderDecider::loadAssets([
    new LandingPageJsFile("jquery.min.js"),
    new LandingPageJsFile("theme-vendors.js"),
    new LandingPageJsFile("theme.min.js"),
], new ScriptsLoaderStrategy())

?>