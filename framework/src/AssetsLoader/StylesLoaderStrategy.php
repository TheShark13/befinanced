<?php


namespace AssetsLoader;

/**
 * Class StylesLoaderStrategy
 *
 * Load styles files (CSSs, SCSSs, etc)
 *
 * @package AssetsLoader
 */
class StylesLoaderStrategy extends AbstractAssetsLoader
{

    /**
     * @inheritDoc
     * @param string $path
     * @return string
     */
    protected function getLoadRowHtmlFormat(string $path): string
    {
        return sprintf('<link rel="stylesheet" href="%s" />', $path);
    }
}