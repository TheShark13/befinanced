<?php

namespace AssetsLoader;

use Storage\Entity\AbstractFile;

/**
 * Class AbstractAssetsLoader
 * @package AssetsLoader
 */
abstract class AbstractAssetsLoader implements AssetsLoaderStrategy
{
    /**
     * @param AbstractFile[] $files
     * @return string
     */
    public function load(array $files): string
    {
        return array_reduce(
            $files,
            fn(string $carry, AbstractFile $file) => $carry . $this->getLoadRowHtmlFormat($file->getFilePath()),
            ""
        );
    }

    /**
     * Generate html code for load asset
     *
     * @param string $path
     * @return string
     */
    abstract protected function getLoadRowHtmlFormat(string $path): string;
}