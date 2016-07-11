<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 15:13
 */

namespace Blog\Core\Implementation;


use Blog\Core\Engine;

/**
 * Class PhpTemplateEngine
 *
 * @package blog/core
 */
class PhpTemplateEngine implements Engine
{

    /**
     * {@inheritdoc}
     */
    public function parseTpl($tpl)
    {
        return $tpl;
    }

    /**
     * {@inheritdoc}
     */
    public function parseVars(array $vars)
    {
        return $vars;
    }
}