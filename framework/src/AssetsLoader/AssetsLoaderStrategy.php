<?php

namespace AssetsLoader;

/**
 * Interface AssetsLoaderStrategy
 * User for defining assets loading strategies
 * @package AssetsLoader
 */
interface AssetsLoaderStrategy
{
    /**
     * @param array $filesPaths
     * @return string
     */
    public function load(array $filesPaths): string;
}