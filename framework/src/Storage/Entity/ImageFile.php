<?php


namespace Storage\Entity;

/**
 * Class ImageFile
 *
 * Designed for images
 *
 * @package Storage\Entity
 */
class ImageFile extends AbstractFile
{
    protected const STORAGE_FOLDER = "img";

    /**
     * @return string
     */
    public function getStorageFolder(): string
    {
        return self::STORAGE_FOLDER;
    }
}