<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 02.07.16
 * Time: 19:31
 */

namespace Blog\SecurityComponent;

/**
 * Interface Security
 *
 * @package blog/security-component
 */
interface Security
{
    /**
     * Basic auth type
     */
    const AUTH_TYPE_BASIC = 'basic';

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
     * User logout
     *
     * @return bool
     */
    public function logOut();

    /**
     * Checkes weither user is grantes of privilege on object
     *
     * @param string $privelege privilege
     *
     * @param int $userId user ID
     *
     * @param mixed $obj
     *
     *
     * if $userId is not defined current user is will be checked by grants
     * if $obj is not defined it means that privelege is not binded to something
     * @return bool
     */
    public function isGranted($privilege, $userId = null, $obj = null);

    /**
     * Refreshes user from storage
     *
     * @return bool
     */
    public function refresh();

    /**
     * Refreshes user
     *
     * @param string $type auth
     *
     * @return bool
     */
    public function register($type);

    /**
     * Confrims operation (registration or Authentication)
     *
     * @param string $key key
     *
     * @return bool
     */
    public function confirm($key);

}