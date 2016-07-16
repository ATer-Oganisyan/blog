<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 0:34
 */

namespace Blog\SecurityModule\Model;

/**
 * Interface Security
 *
 * @package blog/security-module
 */
interface Security
{
    /**
     * Gets user by ID
     *
     * @param int $id user ID
     *
     * returns current user if id is not provided
     * @return array
     */
    public function getUser($id = null);

    /**
     * Gets user collection by them ID collection
     *
     * @param array $userIds ID collection
     *
     * @return array
     */
    public function getUsers(array $userIds);

    /**
     * Authenticate user
     *
     * @param string $type auth type
     *
     * @param array $credentionals ridentionals
     *
     * @return array
     */
    public function auth($type, array $credentionals);

    /**
     * Returns true if user is authorized
     *
     * @return bool
     */
    public function authorized();



    /**
     * User logout
     *
     * @return bool
     */
    public function logOut();
}