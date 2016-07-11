<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 0:57
 */

namespace Blog\SecurityComponent\Implementation;

use Blog\SecurityComponent\Storage;

/**
 * Class Session
 *
 * @package blog/security-component
 */
class Session implements Storage
{

    /**
     * Session
     *
     * @var array
     */
    protected $session;

    /**
     * {@inheritdoc}
     */
    public function __construct(array &$session)
    {
        $this->session = &$session;
    }

    /**
     * {@inheritdoc}
     */
    public function set(array $user)
    {
        $this->session['user'] = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        if (isset($this->session['user'])) {
            return $this->session['user'];
        }
        return [];
    }

}