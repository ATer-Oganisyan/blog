<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 22:01
 */

namespace Blog\BaseRequestHandler\Validator\Implementation;

use Blog\BaseRequestHandler\Validator\DataTypeValidator;
use Blog\BaseRequestHandler\Validator\Exception\RequestValidatorException;
use Blog\BaseRequestHandler\Validator\Exception\UnsupportedTypeException;
use Blog\BaseRequestHandler\Validator\RequestValidator;

/**
 * Class RequestValidatorImplementation
 *
 * @package blog/base-request-Handler
 */
class RequestValidatorImplementation implements RequestValidator
{

    /**
     * Data type validator
     *
     * @var array
     */
    protected $dtv;

    /**
     * {@inheritdoc}
     */
    public function validate($key, $type, array $reqeust)
    {
        if (!isset($reqeust[$key])) {
            throw new RequestValidatorException($key);
        }

        $value = $reqeust[$key];

        if (!isset($this->dtv[$type])) {
            throw new UnsupportedTypeException($type);
        }

        return $this->dtv[$type]->validate($value);
    }

    /**
     * Adds new data type validator
     *
     * @param DataTypeValidator $dtv data type validator
     *
     * @param $type
     */
    public function addDataTypeValidator(DataTypeValidator $dtv, $type)
    {
        $this->dtv[$type] = $dtv;
    }
}