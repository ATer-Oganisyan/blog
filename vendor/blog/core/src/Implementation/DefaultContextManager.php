<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 14:20
 */

namespace Blog\Core\Implementation;


use Blog\Core\ContextManager;
use Blog\Core\Exception\UndefinedContextException;
use Blog\Core\Exception\UnknownContextException;

class DefaultContextManager implements ContextManager
{

    /**
     * Renderers
     *
     * @var array
     */
    protected $renderers = [];

    /**
     * Headers
     *
     * @var array
     */
    protected $headers = [
        'json' => [
            'content-type' => 'application/json'
        ],
        'html' => [
            'content-type' => 'text/html'
        ],
    ];

    /**
     * DefaultContextManager constructor.
     *
     * @param string $engine
     */
    public function __construct($engine)
    {
        $this->renderers['html'] = new HtmlRenderer($engine);
        $this->renderers['json'] = new JsonRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function content(array $content, $context, $tpl = null)
    {
       if (!isset($this->renderers[$context])) {
           throw new UndefinedContextException($context);
       }
       return $this->renderers[$context]->render($content, $tpl);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaders($context)
    {
        return $this->headers[$context];
    }
}