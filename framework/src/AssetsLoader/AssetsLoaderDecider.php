<?php


namespace AssetsLoader;

use Storage\Entity\AbstractFile;

/**
 * Class AssetsLoaderDecider
 * @package AssetsLoader
 */
class AssetsLoaderDecider
{
    /**
     * @param AbstractFile[] $files
     * @param AssetsLoaderStrategy $assetsLoaderStrategy
     * @return string
     */
    public static function loadAssets(array $files, AssetsLoaderStrategy $assetsLoaderStrategy): string
    {
        return $assetsLoaderStrategy->load($files);
    }
}