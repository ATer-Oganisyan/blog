<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 10.07.16
 * Time: 18:34
 */

namespace Blog\Db\Exception;


class UndefinedDbConnectParamException extends \RuntimeException
{
    /**
     * Message template
     *
     * @var string
     */
    protected $tpl = 'Parameter %s is not defined';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->tpl, $message), $code, $previous);
    }
}