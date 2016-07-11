<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 22:23
 */

namespace Blog\BaseRequestHandler\Validator\Exception;

/**
 * Class MaxLengthExceedException
 *
 * @package blog/base-request-handler
 */
class UnsupportedTypeException extends \RuntimeException
{

    /**
     * Template
     *
     * @var string
     */
    protected $tpl = 'Type %s is not supported';

    /**
     * {@inhertdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->tpl, $message), $code, $previous);
    }
}