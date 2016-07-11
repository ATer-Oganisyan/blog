<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 10.07.16
 * Time: 10:14
 */

namespace Blog\Core\Implementation;
use Blog\Core\Exception\UnknownTemplateEngineException;

use Blog\Core\Engine;
use Blog\Core\Implementation\PhpTemplateEngine;

/**
 * Class EngineFactory
 *
 * @package blog/core
 */
class EngineFactory
{

    protected static $engines = [
        'php' => 'Blog\Core\Implementation\PhpTemplateEngine'
    ];

    /**
     * Gets template engine
     *
     * @param string $engine engine
     *
     * @return Engine
     */
    public static function get($engine)
    {
        if (!isset(self::$engines[$engine])) {
            throw new UnknownTemplateEngineException($engine);
        }

        return new self::$engines[$engine];
    }
}