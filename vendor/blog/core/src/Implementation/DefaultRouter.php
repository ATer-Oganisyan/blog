<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 13:47
 */

namespace Blog\Core\Implementation;


use Blog\Core\Exception\RouteNotFoundException;
use Blog\Core\Exception\UndefinedContextException;
use Blog\Core\Exception\UndefinedControllerException;
use Blog\Core\Exception\UndefinedActionException;
use Blog\Core\Router;

/**
 * Class DefaultRouter
 *
 * @package blog/core
 */
class DefaultRouter implements Router
{

    /**
     * Current routing
     *
     * @var array
     */
    protected $routing;

    /**
     * {@inheritdoc}
     */
    public function config(array $routing)
    {
        $this->routing = $routing;
    }

    /**
     * {@inheritdoc}
     */
    public function match($uri, $method)
    {
        if (!isset($this->routing[$uri])) {
            throw new RouteNotFoundException('unknown URI');
        }

        if (isset($this->routing[$uri]['method']) && !in_array($method, $this->routing[$uri]['method'])) {
            throw new RouteNotFoundException(sprintf('Method %s is not alowed', $method));
        }


        if (!isset($this->routing[$uri]['context'])) {
            throw new UndefinedContextException();
        }

        if (!isset($this->routing[$uri]['controller'])) {
            throw new UndefinedControllerException();
        }

        if (!isset($this->routing[$uri]['action'])) {
            throw new UndefinedActionException();
        }

        return $this->routing[$uri];
    }
}