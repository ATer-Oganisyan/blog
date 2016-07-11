<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 0:40
 */

namespace Blog\SecurityModule\Model\Implementation;

use Blog\SecurityComponent\Exception\WrongCredentionalsException;
use Blog\SecurityModule\Model\Security;
use Blog\SecurityComponent\Security as Component;
/**
 * Class SecurityImplementation
 *
 * @package blog/security-module
 */
class SecurityImplementation implements Security
{
    /**
     * Security component
     *
     * @var Component
     */
    protected $component;

    /**
     * SecurityImplementation constructor
     *
     * @param Component $component security component
     */
    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * @inheritdoc
     */
    public function getUser($id = null)
    {
        return $this->component->getUser($id);
    }

    /**
     * @inheritdoc
     */
    public function getUsers(array $userIds)
    {
        return $this->component->getUsers($userIds);
    }

    /**
     * @inheritdoc
     */
    public function auth($type, array $credentionals)
    {
        try {
            return $this->component->auth($type, $credentionals);
        } catch (WrongCredentionalsException $e) {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function logOut()
    {
        return $this->component->logOut();
    }
}