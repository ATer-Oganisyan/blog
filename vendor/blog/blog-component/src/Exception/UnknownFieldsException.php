<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 23:35
 */

namespace Blog\BlogComponent\Exception;

/**
 * Class UnknownFieldsException
 *
 * @package blog/blog-component
 */
class UnknownFieldsException extends UndefinedFieldsException
{
    /**
     * Message template
     *
     * @var string
     */
    protected $tpl = 'Unknown fields %s';
}