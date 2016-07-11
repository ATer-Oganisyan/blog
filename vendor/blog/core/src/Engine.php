<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 15:03
 */

namespace Blog\Core;

/**
 * Interface Engine
 *
 * @package blog\core
 */
interface Engine
{
    /**
     * Parses template
     *
     * @param string $tpl path to template
     *
     * returns path to compiled template
     * @return string
     */
    public function parseTpl($tpl);

    /**
     * Parses template variables
     *
     * @param array $vars variables
     *
     * returns compiled variables
     *
     * @return array
     */
    public function parseVars(array $vars);


}