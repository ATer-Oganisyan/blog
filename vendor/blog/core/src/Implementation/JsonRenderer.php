<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 15:00
 */

namespace Blog\Core\Implementation;

use Blog\Core\Renderer;

/**
 * Class JsonRenderer
 *
 * @package blog/core
 */
class JsonRenderer implements Renderer
{

    /**
     * {@inheritdoc}
     */
    public function render(array $content, $tpl)
    {
        return json_encode($content);
    }
}