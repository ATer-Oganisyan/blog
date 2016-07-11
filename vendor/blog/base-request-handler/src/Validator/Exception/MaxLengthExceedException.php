<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 23:04
 */

namespace Blog\BaseRequestHandler\Validator\Exception;

/**
 * Class MaxLengthExceedException
 *
 * @package blog/base-request-handler
 */
class MaxLengthExceedException extends RequestValidatorException
{
    /**
     * @var string
     */
    protected $temlate = 'Maximum lenght of string %d is exceeded';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->temlate, $message), $code, $previous);
    }
}