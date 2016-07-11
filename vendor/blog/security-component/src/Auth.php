<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 03.07.16
 * Time: 15:08
 */

namespace Blog\SecurityComponent;


interface Auth
{

    /**
     * Gets user by ID
     *
     * @param int $id user ID
     *
     * returns current user if id is not provided
     * @return array
     */
    public function getUser($id);

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
     * @param array $credentionals ridentionals
     *
     * @return array
     */
    public function auth(array $credentionals);
}