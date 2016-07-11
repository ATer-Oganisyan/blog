<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 05.07.16
 * Time: 0:28
 */

namespace Blog\SecurityComponent\Exception;

/**
 * Class WrongCredentionalsException
 *
 * @package blog/security-component
 */
class UndefinedCredentionalsException extends \RuntimeException
{

    /**
     * This exception message
     *
     * @var string
     */
    protected $message = 'Undefined creditionals';

    /**
     * @inheritdoc
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($this->message, $code, $previous);
    }
}