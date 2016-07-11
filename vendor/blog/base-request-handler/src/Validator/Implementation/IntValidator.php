<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 22:31
 */

namespace Blog\BaseRequestHandler\Validator\Implementation;


use Blog\BaseRequestHandler\Validator\DataTypeValidator;

/**
 * Class IntValidator
 * @package blog/base-request-handler
 */
class IntValidator implements DataTypeValidator
{

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        return (int) $data;
    }
}