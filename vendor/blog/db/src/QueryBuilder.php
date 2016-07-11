<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 2:03
 */

namespace Blog\Db;

/**
 * Interface QueryBuilder
 *
 * @package blog/db
 */
interface QueryBuilder
{

    /**
     * Builds "insert" query
     *
     * @param array $mapper mapper
     *
     * @param array $entity entity
     *
     * @return array
     */
    public function insert(array $mapper, array $entity);

    /**
     * @param array $mapper mapper
     *
     * @param array $fields fields
     *
     * @param array $conditions conditions
     *
     * @param array $orderBy order by section
     *
     * @param array $limit limit sections
     *
     * @return array
     */
    public function select(array $mapper, array $fields, array $conditions = null, array $orderBy = null, array $limit = null);
}