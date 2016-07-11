<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 08.07.16
 * Time: 22:03
 */

namespace Blog\Db\Exception;

/**
 * Class UnsupportedOperationException
 *
 * @package blog/db
 */
class UnkonwnDirectionException extends \RuntimeException
{
    /**
     * Message template
     *
     * @var string
     */
    protected $tpl = 'Direction must be asc or desc, %s given';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf($this->tpl, $message), $code, $previous);
    }

}