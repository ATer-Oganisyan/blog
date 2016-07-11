<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 23:59
 */

namespace Blog\BlogComponent\Implementation;
use Blog\BlogComponent\Exception\UndefinedFieldsException;
use Blog\BlogComponent\Exception\UnknownFieldsException;

/**
 * Trait FieldChecker
 *
 * @package blog/blog-component
 */
trait FieldsChecker
{
    /**
     * Checks fields
     *
     * @param array $fields fields
     *
     * @return void
     */
    protected function checkFields(array $fields)
    {
        if ($fields == []) {
            throw new UndefinedFieldsException();
        }

        if (array_intersect($fields, array_keys($this->mapper['fields'])) < $fields) {
            throw new UnknownFieldsException(implode(', ', $fields));
        }
    }
}