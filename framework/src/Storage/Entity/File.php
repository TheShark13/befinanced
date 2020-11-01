<?php


namespace Storage\Entity;

/**
 * Class File
 *
 * Describe general files who are uploaded on this app
 *
 * @package Storage\Entity
 */
class File extends AbstractFile
{
    /**
     * @var string
     */
    protected const STORAGE_FOLDER = "uploaded-files";

    /**
     * @return string
     */
    public function getStorageFolder(): string
    {
        return self::STORAGE_FOLDER;
    }
}