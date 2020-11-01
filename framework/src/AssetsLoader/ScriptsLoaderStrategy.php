<?php


namespace AssetsLoader;

/**
 * Class ScriptsLoaderStrategy
 *
 * Load scripts files (js, etc)
 *
 * @package AssetsLoader
 */
class ScriptsLoaderStrategy extends AbstractAssetsLoader
{
    /**
     * @inheritDoc
     * @param string $path
     * @return string
     */
    protected function getLoadRowHtmlFormat(string $path): string
    {
        return sprintf('<script src="%s"></script>', $path);
    }
}