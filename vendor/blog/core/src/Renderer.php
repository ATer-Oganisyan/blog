<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 14:42
 */

namespace Blog\Core;

/**
 * Interface Renderer
 *
 * @package blog\core
 */
interface Renderer
{

    /**
     * Renders template
     *
     * @param array $content
     *
     * @param string $tpl
     *
     * @return string
     */
    public function render(array $content, $tpl);
}