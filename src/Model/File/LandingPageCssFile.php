<?php


namespace App\Model;

use Storage\Entity\CssFile;

/**
 * Class LandingPageCssFile
 *
 * Landing page css file
 *
 * @package Storage\Entity
 */
class LandingPageCssFile extends CssFile
{
    protected const LANDING_PAGE_STORAGE = "landing-page/";

    /**
     * @return string
     */
    public function getStorageFolder(): string
    {
        return self::LANDING_PAGE_STORAGE . parent::getStorageFolder();
    }
}