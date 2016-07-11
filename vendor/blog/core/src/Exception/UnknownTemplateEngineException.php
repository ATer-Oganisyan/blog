<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 14:53
 */

namespace Blog\Core\Exception;

/**
 * Class UnknownContextException
 *
 * @package blog/core
 */
class UnknownTemplateEngineException extends \RuntimeException
{
    /**
     * Message template
     *
     * @var string
     */
    protected $tpl = 'Unknown engine \'%s\'';

    /**
     * {@inheritdoc}
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->tpl, $message), $code, $previous);
    }
}


