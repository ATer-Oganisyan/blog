<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 13:34
 */

namespace Blog\Core;

/**
 * Interface ContextManager
 *
 * @package blog/core
 */
interface ContextManager
{
    /**
     * Context manager
     *
     * @param array $content
     *
     * @param string $context context
     *
     * @param string $tpl path to template
     *
     * @return string
     */
    public function content(array $content, $context, $tpl = null);

    /**
     * Gets headers
     *
     * @param string $context gets headers
     *
     * @return array
     */
    public function getHeaders($context);
}