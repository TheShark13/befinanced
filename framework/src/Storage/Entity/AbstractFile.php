<?php


namespace Storage\Entity;

/**
 * Class AbstractFile
 * @package Storage\Entity
 */
abstract class AbstractFile
{
    /**
     * Filename of current file
     *
     * @var string
     */
    protected string $filename;

    /**
     * AbstractFile constructor.
     * @param string $filename
     */
    public function __construct(string $filename = "")
    {
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     * @return AbstractFile
     */
    public function setFilename(string $filename): AbstractFile
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return string
     */
    abstract public function getStorageFolder(): string;

    /**
     * @return string
     */
    public function getStoragePath(): string
    {
        return $this->getStorageFolder();
    }

    /**
     * File full path
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->getStorageFolder() . '/' . $this->filename;
    }
}
