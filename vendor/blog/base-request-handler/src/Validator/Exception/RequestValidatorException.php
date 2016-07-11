<?php

namespace Blog\BaseRequestHandler\Validator\Exception;

/**
 * Class RequestValidatorException
 *
 * @package blog/base-request-handler
 */
class RequestValidatorException extends \RuntimeException
{

    /**
     * @var string
     */
    protected $temlate = 'Invalid parameter %s';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->temlate, $message), $code, $previous);
    }

}