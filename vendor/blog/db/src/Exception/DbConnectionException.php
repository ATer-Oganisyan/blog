<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 10.07.16
 * Time: 18:41
 */

namespace Blog\Db\Exception;

/**
 * Class DbConnectionException
 *
 * @package blog/db
 */
class DbConnectionException extends \RuntimeException
{

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}