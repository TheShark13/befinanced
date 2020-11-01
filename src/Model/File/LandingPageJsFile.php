<?php


namespace App\Model;

use Storage\Entity\JsFile;

/**
 * Class LandingPageCssFile
 *
 * Landing page css file
 *
 * @package Storage\Entity
 */
class LandingPageJsFile extends JsFile
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