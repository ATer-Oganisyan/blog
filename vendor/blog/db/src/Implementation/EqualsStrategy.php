<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 22:20
 */

namespace Blog\Db\Implementation;


use Blog\Db\Condition;

/**
 * Class EqualsStrategy
 *
 * @package blog/db
 */
class EqualsStrategy implements Condition
{

    /**
     * {@inheritdoc}
     */
    public function get($field, $value)
    {
        return [
            'statement' => "`$field` = :ph_$field",
            'binds' => ["ph_$field" => $value]
        ];
    }
}