<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 13:32
 */

namespace Blog\Core;

/**
 * Interface Router
 *
 * @package blog/core
 */
interface Router
{

    /**
     * Matcher route to URI
     *
     * @param string $uri URI
     *
     * @param string $method request method
     *
     * @return array
     */
    public function match($uri, $method);

    /**
     * Configures routing
     *
     * @param array $routing routing
     *
     * @return void
     */
    public function config(array $routing);
}