<?php


namespace Storage\Entity;

/**
 * Class CssFile
 *
 * Designed for CSS file type
 *
 * @package Storage\Entity
 */
class CssFile extends AbstractFile
{
    protected const STORAGE_FOLDER = "css";

    /**
     * @return string
     */
    public function getStorageFolder(): string
    {
        return self::STORAGE_FOLDER;
    }
}