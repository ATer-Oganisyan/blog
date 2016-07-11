<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 23:17
 */

namespace Blog\BaseRequestHandler\Validator\Exception;

/**
 * Class MaxLengthExceedException
 *
 * @package blog/base-request-handler
 */
class RegexpConstraintViolationException extends RequestValidatorException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct('String is not matched to regexp', $code, $previous);
    }
}