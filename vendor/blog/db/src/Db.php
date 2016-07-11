<?php

namespace Blog\Db;

/**
 * Interface Db
 *
 * @package blog/db
 */
interface Db
{

    /**
     * @param string $connection connection name
     *
     * @param array $mapper mapper
     *
     * @param array $fields fields
     *
     * @param array $conditions conditions
     *
     * @param array $orderBy order by
     *
     * @param array $limit limit
     *
     * @return array
     */
    public function select($connection, array $mapper, array $fields, array $conditions, array $orderBy = null, array $limit = null);

    /**
     * Inserts row
     *
     * @param string $connection connection name
     *
     * @param array $mapper mapper
     *
     * @param array $row row
     *
     * @return void
     */
    public function insert($connection, array $mapper, array $row);

}