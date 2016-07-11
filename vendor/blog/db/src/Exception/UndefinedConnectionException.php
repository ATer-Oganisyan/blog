<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 11.07.16
 * Time: 1:53
 */

namespace Blog\Db\Exception;

/**
 * Class UndefinedConnectionException
 *
 * @package blog/db
 */
class UndefinedConnectionException extends \RuntimeException
{

    /**
     * Message template
     *
     * @var string
     */
    protected $tpl = 'Connection %s is not defined';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->tpl, $message), $code, $previous);
    }
}