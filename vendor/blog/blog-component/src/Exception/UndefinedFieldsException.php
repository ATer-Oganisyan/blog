<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 23:21
 */

namespace Blog\BlogComponent\Exception;

/**
 * Class UndefinedFieldsException
 *
 * @package blog/blog-component
 */
class UndefinedFieldsException extends \RuntimeException
{
    /**
     * Meessage template
     *
     * @var string
     */
    protected $tpl = '%s fields is not defined';

    /**
     * {@inheritdoc}.
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->tpl, $message), $code, $previous);
    }
}