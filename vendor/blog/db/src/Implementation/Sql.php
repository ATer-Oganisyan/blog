<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 19:46
 */

namespace Blog\Db\Implementation;


use Blog\Db\QueryBuilder;
use Blog\Db\Exception\BadMapperException;
use Blog\Db\Exception\UnsupportedEntityException;
use Blog\Db\Exception\UnkonwnDirectionException;
use Blog\Db\Exception\UnsupportedOperationException;

/**
 * Class Sql
 *
 * @package blog/db
 */
class Sql implements QueryBuilder
{

    /**
     * Condition strategies
     *
     * @var array
     */
    protected $conditionStrategies = [];

    /**
     * Sql constructor.
     */
    public function __construct()
    {
        $this->conditionStrategies['equals'] = new EqualsStrategy;
        $this->conditionStrategies['in']     = new InStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function insert(array $mapper, array $entity)
    {
        $this->checkMapper($mapper);
        $this->checkFields($mapper, array_keys($entity));
        $statement = "insert into {$mapper['table']} ({$this->buildFields($mapper, $entity)})";
        $statement .= "values (".array_map(function ($key){return ":$key";}, array_keys($entity)).")";
        return ['statement' => $statement, 'binds' => $entity];
    }

    /**
     * {@inheritdoc}
     */
    public function select(array $mapper, array $fields, array $conditions = null, array $orderBy = null, array $limit = null)
    {
        $this->checkMapper($mapper);
        $this->checkFields($mapper, $fields);
        $f = $this->buildFields($mapper, $fields);
        $binds = [];
        $w = '';
        if (count($conditions) > 0) {
            $where = $this->getWhereSection($mapper, $conditions);
            $binds = $where['binds'];
            $w = "where " . $where['sql'];
        }

        $o = '';
        if (count($orderBy) > 0) {
            $o = "order by " . $this->getOrderSection($mapper, $orderBy);
        }

        $l = '';
        if (count($limit) == 1) {
            list($limit) = $limit;
            $l = "limit $limit";
        }

        if (count($limit) == 2) {
            list($offset, $limit) = $limit;
            $l = "limit $offset, $limit";
        }

        return [
            'statement' => "select $f from {$mapper['table']} $w $o $l",
            'binds'     => $binds
        ];

    }

    /**
     * Gets order by section
     *
     * @param array $mapper mapper
     *
     * @param array $orderBy order by
     *
     * @return string
     */
    protected function getOrderSection(array $mapper, array $orderBy)
    {
        $sql = [];
        foreach ($orderBy as list($field, $derection)) {
            $this->checkFields($mapper, [$field]);
            if (!in_array($derection, ['asc', 'desc'])) {
                throw new UnkonwnDirectionException($derection);
            }
            $sql[] = "`{$mapper['fields'][$field]}` $derection";
        }
        return implode(', ', $sql);
    }

    /**
     * Gets where section
     *
     * @param array $mapper mapper
     *
     * @param array $conditions mapper
     *
     * @return array
     */
    protected function getWhereSection(array $mapper, array $conditions)
    {
        $sql = [];
        $binds = [];
        foreach ($conditions as $condition) {
            list($field, $operation, $value) = $condition;
            $this->checkFields($mapper, [$field]);
            if (!isset($this->conditionStrategies[$operation])) {
                throw new UnsupportedOperationException($operation);
            }

            $c = $this->conditionStrategies[$operation]->get($field, $value);
            $sql[] = $c['statement'];
            $binds += $c['binds'];
        }

        return [
            'sql'   => implode(' and ', $sql),
            'binds' => $binds
        ];
    }

    /**
     * Builds insert fields
     *
     * @param array $mapper mapper
     *
     * @param array $entity entity
     *
     * @return string
     */
    protected function buildFields(array $mapper, array $fields)
    {
        $f = [];
        foreach ($fields as $key) {
            $f[] = "`{$mapper['fields'][$key]}`";
        }
        return implode(', ', $f);
    }

    /**
     * Checks insert
     *
     * @param array $mapper mapper
     *
     * @param array $entity entity
     *
     * @return void
     */
    protected function checkFields(array $mapper, array $fields)
    {
        if (array_intersect($mapper['fields'], $fields) < $fields) {
            $m = implode(', ', $mapper['fields']);
            $e = implode(', ', $fields);
            throw new UnsupportedEntityException(sprintf('mapper (%s), entity (%s)', $m, $e));
        }
    }

    /**
     * Checks mapper
     *
     * @param array $mapper
     */
    protected function checkMapper(array $mapper)
    {
        foreach (['table', 'fields'] as $key) {
            if (!isset($mapper[$key]) || !is_array($mapper['fields'])) {
                throw new BadMapperException();
            }
        }
    }
}