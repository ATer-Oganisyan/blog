<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 03.07.16
 * Time: 15:37
 */

namespace Blog\SecurityComponent;

/**
 * Interface Storage
 *
 * @package blog/security-component
 */
interface Storage
{
    /**
     * Gets user from storage
     *
     * @return array
     */
    public function get();

    /**
     * Sets user tostorage
     *
     * @param array $user user
     *
     * @return void
     */
    public function set(array $user);

}