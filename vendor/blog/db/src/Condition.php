<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 21:06
 */

namespace Blog\Db;

/**
 * Interface Condition
 *
 * @package blog\db
 */
interface Condition
{
    /**
     * @param string $field field
     *
     * @param string|array $value value
     *
     * @return array
     */
    public function get($field, $value);
}