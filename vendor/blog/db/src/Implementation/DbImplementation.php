<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 06.07.16
 * Time: 23:52
 */

namespace Blog\Db\Implementation;

use Blog\Db\Connection;
use Blog\Db\Db;
use Blog\Db\QueryBuilder;
use Blog\Db\Exception\UndefinedConnectionException;

/**
 * Class Mysql
 *
 * @package blog/db
 */
class DbImplementation implements Db
{
    /**
     * Connection protorype
     *
     * @var Connection
     */
    protected $prototype;

    /**
     * Config
     *
     * @var array
     */
    protected $config;

    /**
     * Connections
     * @var array
     */
    protected $connections = [];

    /**
     * Query builder
     *
     * @var QueryBuilder
     */
    protected $builder;

    /**
     * Mysql constructor
     *
     * @param array $config DB config
     *
     * @param Connection $prototype connection prototype
     */
    public function __construct(array $config, Connection $prototype, QueryBuilder $builder)
    {
        $this->prototype = $prototype;
        $this->config    = $config;
        $this->builder   = $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function select($connection, array $mapper, array $fields, array $conditions, array $orderBy = null, array $limit = null)
    {
        $this->connect($connection);
        $query = $this->builder->select($mapper, $fields, $conditions, $orderBy, $limit);
        return $this->connections[$connection]->query($query['statement'], $query['binds']);
    }

    /**
     * {@inheritdoc}
     */
    public function insert($connection, array $mapper, array $row)
    {
        $this->connect($connection);
        $query = $this->builder->insert($mapper, $row);
        return $this->connections[$connection]->query($query['statement'], $query['binds']);
    }

    /**
     * Coneects to DB if its'not connected
     *
     * @param string $connection connection
     *
     * @return void
     */
    protected function connect($connection)
    {
        if (isset($this->connections[$connection])) {
            return;
        }

        if (!isset($this->config[$connection])) {
            throw new UndefinedConnectionException($connection);
        }

        $conn = clone $this->prototype;

        $conn->connect($this->config[$connection]);
        $this->connections[$connection] = $conn;
    }
}