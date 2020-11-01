<?php


namespace Storage\Entity;

/**
 * Class JsFile
 *
 * Designed for JS file type
 *
 * @package Storage\Entity
 */
class JsFile extends AbstractFile
{
    protected const STORAGE_FOLDER = "js";

    /**
     * @return string
     */
    public function getStorageFolder(): string
    {
        return self::STORAGE_FOLDER;
    }
}