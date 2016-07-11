<?php

namespace Blog\SecurityComponent\Implementation;

use Blog\SecurityComponent\Security;
use Blog\SecurityComponent\Storage;
use Blog\SecurityComponent\Auth;

/**
 * Class SecurityImplementation
 *
 * @package blog/security-component
 */
class SecurityImplementation implements Security
{
    /**
     * Flag refreshing user by every getUser request
     *
     * @var bool
     */
    protected $refreshByEveryRequest;

    /**
     * Storage (session by default)
     *
     * @var Storage
     */
    protected $storage;

    /**
     * User
     *
     * @var array
     */
    protected $user;

    /**
     * Authenticators
     *
     * @var array
     */
    protected $auth = [];


    /**
     * SecurityImplementation constructor
     *
     * @param Storage $storage storage
     *
     * @param bool $refreshByEveryRequest refresh user by every request
     */
    public function __construct(Storage $storage, $refreshByEveryRequest = false)
    {
        $this->refreshByEveryRequest = $refreshByEveryRequest;
        $this->storage = &$storage;
    }

    /**
     * Adds authentication strategy
     *
     * @param string $type auth type
     *
     * @param Auth $auth
     */
    public function addAuthentificatot($type, Auth $auth)
    {
        $this->auth[$type] = $auth;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($id = null)
    {
        if (is_null($id)) {
            return $this->getCurrentUser();
        }

        foreach ($this->auth as $auth) {
            if ($user = $auth->getUser($id)) {
                return $user;
            }
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getUsers(array $userIds)
    {
        $users = [];
        foreach ($this->auth as $auth) {
            if ($user = $auth->getUsers($userIds)) {
                $users += $user;
            }
        }
        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function auth($type, array $credentionals)
    {
        $user = $this->auth[$type]->auth($credentionals);
        $user['type'] = $type;
        $this->storage->set($user);
    }

    /**
     * {@inheritdoc}
     */
    public function logOut()
    {
        // TODO: Implement logOut() method.
    }

    /**
     * {@inheritdoc}
     */
    public function register($type)
    {
        // TODO: Implement register() method.
    }

    /**
     * {@inheritdoc}
     */
    public function refresh()
    {
        if (!empty($user = $this->user) || $user = $this->storage->get()) {
            $freshUser = $this->auth[$user['type']]->getUser($user['id']);
            $this->storage->set($freshUser);
            return $freshUser;
        }
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function confirm($key)
    {
        // TODO: Implement confirm() method.
    }

    /**
     * {@inheritdoc}
     */
    public function isGranted($privilege, $userId = null, $obj = null)
    {
        // TODO: Implement isGranted() method.
        // Getting available privileges from DB, Grant voters, checking ACL, etc
    }

    /**
     * Gets current user
     *
     * @return array
     */
    protected function getCurrentUser()
    {
        if (empty($this->user)) {
            $this->user = $this->getFromStorage();
        }
        return $this->user;
    }

    /**
     * Gets user from storage
     * @return array
     */
    protected function getFromStorage()
    {
        return ($this->refreshByEveryRequest)?($this->refresh()):($this->storage->get());
    }



}