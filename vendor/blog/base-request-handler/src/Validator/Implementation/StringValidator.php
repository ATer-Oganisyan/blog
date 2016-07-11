<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 22:31
 */

namespace Blog\BaseRequestHandler\Validator\Implementation;


use Blog\BaseRequestHandler\Validator\DataTypeValidator;
use Blog\BaseRequestHandler\Validator\Exception\MaxLengthExceedException;
use Blog\BaseRequestHandler\Validator\Exception\EmptyStringException;
use Blog\BaseRequestHandler\Validator\Exception\RegexpConstraintViolationException;


/**
 * Class IntValidator
 * @package blog/base-request-handler
 */
class StringValidator implements DataTypeValidator
{

    /**
     * Max length
     *
     * @var int
     */
    protected $length;

    /**
     * Regexp
     *
     * @var string
     */
    protected $regexp;

    /**
     * StringValidator constructor
     *
     * @param int $length string max length
     *
     * @param string $regexp
     */
    public function __construct($length, $regexp = null)
    {
        $this->length = $length;
        $this->regexp = $regexp;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        $data = strip_tags($data);

        if ($data === '') {
            throw new EmptyStringException();
        }

        if (strlen($data) > $this->length) {
            throw new MaxLengthExceedException($this->length);
        }

        if (!preg_match($this->regexp, $data)) {
            throw new RegexpConstraintViolationException();
        }

        return $data;
    }
}