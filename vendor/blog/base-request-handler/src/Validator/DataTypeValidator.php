<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 21:54
 */

namespace Blog\BaseRequestHandler\Validator;

/**
 * Interface DateTypeValidator
 *
 * @package blog-base-request-handleor
 */
interface DataTypeValidator
{

    /**
     * Validates data
     *
     * @param mixed $data data to validate
     *
     * @return mixed
     */
    public function validate($data);
}