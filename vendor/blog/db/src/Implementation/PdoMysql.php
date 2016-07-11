<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 2:18
 */

namespace Blog\Db\Implementation;

use Blog\Db\Connection;
use Blog\Db\Exception\UndefinedDbConnectParamException;
use Blog\Db\Exception\DbConnectionException;
use Blog\Db\Exception\DbQueryException;

/**
 * Class Mysqli (wraps \mysqli)
 *
 * @package blog/db
 */
class PdoMysql implements Connection
{

    /**
     * @var \PDO
     */
    protected $core;

    /**
     * Config
     *
     * @var array
     */
    protected $config;


    /**
     * {@inheritdoc}
     */
    public function connect(array $config)
    {
        if ($this->config) {
            return;
        }

        $this->checkConfig($config);
        $this->core = new \PDO($this->dsn($config), $config['user'], $config['password']);
        if ($this->core->errorCode()) {
            throw new DbConnectionException($this->core->errorInfo(), $this->core->errorCode());
        }

        $this->config = $config;

    }

    /**
     * {@inheritdoc}
     */
    public function query($statement, array $binds)
    {
        $s = $this->core->prepare($statement);

        foreach ($binds as $key => $value) {
            $s->bindValue($key, $value);
        }

        $s->execute();

        $result = $s->fetchAll();
        $count  = $s->rowCount();

        if ($this->core->errorCode() > 0) {
            throw new DbQueryException(serialize($this->core->errorInfo()));
        }

        return ['result' => $result, 'count' => $count];
    }

    /**
     * {@inheritdoc}
     */
    public function disconnect()
    {
        unset($this->core);
    }

    /**
     * {@inheritdoc}
     */
    public function reconnect()
    {
        $this->disconnect();
        $config = $this->config;
        unset($this->config);
        $this->connect($config);
    }

    /**
     * Destruct
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * Checks config
     *
     * @param array $config config
     */
    protected function checkConfig(array $config)
    {
        foreach (['db', 'host', 'user', 'password'] as $key) {
            if (!isset($config[$key])) {
                throw new UndefinedDbConnectParamException($key);
            }
        }
    }

    /**
     * DSN of connection
     *
     * @return string
     */
    protected function dsn(array $config)
    {
        $dsn = "mysql:dbname={$config['db']};host={$config['host']}";

        if (isset($config['port'])) {
            $dsn .= ";port={$config['db']}";
        }

        return $dsn;
    }
}