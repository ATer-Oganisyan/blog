<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 1:36
 */

namespace Blog\Db;

/**
 * Interface Connection
 *
 * @package blog\Db
 */
interface Connection
{

    /**
     * Connects to DB
     *
     * @param array $config config
     *
     * @return void
     */
    public function connect(array $config);

    /**
     * Disconects from DB
     *
     * @return void
     */
    public function disconnect();

    /**
     * REconnects to DB
     *
     * @return void
     */
    public function reconnect();

    /**
     * Makes query to DB
     *
     * @param string $statement prepared statment
     *
     * @param array $binds binds
     *
     * @return array
     */
    public function query($statement, array $binds);
}