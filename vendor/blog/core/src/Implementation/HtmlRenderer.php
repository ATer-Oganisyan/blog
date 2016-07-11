<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 15:18
 */

namespace Blog\Core\Implementation;


use Blog\Core\Engine;
use Blog\Core\Renderer;

/**
 * Class HtmlRenderer
 *
 * @package blog/core
 */
class HtmlRenderer implements Renderer
{

    /**
     * Content
     *
     * @var array
     */
    protected $content;

    /**
     * Engine
     *
     * @var Engine
     */
    protected $engine;

    /**
     * HtmlRenderer constructor
     *
     * @param string $engine engine
     *
     * @return void
     */
    public function __construct($engine)
    {
        $this->engine = EngineFactory::get($engine);
    }

    /**
     * {@inheritdoc}
     */
    public function render(array $content, $tpl)
    {
        $this->content = $this->engine->parseVars($content);
        ob_start();
        $this->requireTemplte($tpl);
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }

    protected function requireTemplte($tpl)
    {
        // if (ceache->getTemplate) return cache->getTemplate
        // echo '<pre>'; print_r($this->engine->parseTpl($tpl)); die();
        require $this->engine->parseTpl($tpl);
    }
}