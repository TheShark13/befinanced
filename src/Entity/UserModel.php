<?php


namespace App\Entity;

/**
 * Interface UserModel
 */
interface UserModel
{
    /**
     * User identification name
     *
     * @return mixed
     */
    public function getUsername();

    /**
     * User password hash
     *
     * @param string $password
     * @return string
     */
    public function hashPassword(string $password): string;
}