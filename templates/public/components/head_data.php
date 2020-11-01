<?php

use App\Model\LandingPageCssFile;
use App\Model\LandingPageJsFile;
use AssetsLoader\AssetsLoaderDecider;
use AssetsLoader\StylesLoaderStrategy;

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#3ed2a7">

    <link rel="shortcut icon" href="./favicon.png"/>

    <title><?= $title ?></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto%7cRubik:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
          integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
          crossorigin="anonymous"/>
    <?=
    AssetsLoaderDecider::loadAssets([
        new LandingPageCssFile("theme-vendors.min.css"),
        new LandingPageCssFile("theme.min.css"),
        new LandingPageCssFile("opus.css")
    ], new StylesLoaderStrategy())

    ?>

    <?=
    AssetsLoaderDecider::loadAssets([
        new LandingPageJsFile("modernizr.min.js"),
    ], new StylesLoaderStrategy())

    ?>
</head>