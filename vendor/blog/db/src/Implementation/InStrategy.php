<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 22:26
 */

namespace Blog\Db\Implementation;

use Blog\Db\Condition;
use Blog\Db\Exception\ConditionWrongValueException;

/**
 * Class InStrategy
 *
 * @package blog/db
 */
class InStrategy implements Condition
{
    /**
     * {@inheritdoc}
     */
    public function get($field, $values)
    {
        if (count($values) == 0) {
            throw new ConditionWrongValueException();
        }

        $in = [];
        $binds = [];
        foreach ($values as $key => $value) {
            $in[] = ":ph_{$field}_{$key}";
            $binds["ph_{$field}_{$key}"] = $value;
        }

        return [
            'statement' => "`$field` in (" . implode(', ', $in) . ")",
            'binds' => $binds
        ];
    }
}