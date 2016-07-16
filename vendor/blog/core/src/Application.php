<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 09.07.16
 * Time: 12:12
 */

namespace Blog\Core;

use Blog\BaseRequestHandler\Response;
use Blog\Core\ContextManager;
use Blog\Core\Router;
use Blog\Core\Exception\RouteNotFoundException;
use Blog\Core\Implementation\DefaultContextManager;
use Blog\Core\Implementation\DefaultRouter;
/**
 * Class Application
 *
 * @package Blog/Core
 */
class Application
{

    /**
     * Router
     *
     * @var Router
     */
    protected $router;

    /**
     * Controller locator
     *
     * @var array
     */
    protected $routing;

    /**
     * Controller locator
     *
     * @var array
     */
    protected $locator;

    /**
     * Registry
     *
     * @var array
     */
    protected $registry = [];

    /**
     * Application constructor
     *
     * @param array $routing routing
     *
     * @param array $locator controller locator
     *
     * @param Router|null $router
     */
    public function __construct(array $routing, array $locator, Router $router = null, ContextManager $context = null, $tplEngine = 'php')
    {
        $this->routing = $routing;
        $this->locator = $locator;
        $this->router = !is_null($router)?$router:(new DefaultRouter);
        $this->router->config($routing);
        $this->context = !is_null($context)?$router:(new DefaultContextManager($tplEngine));
    }

    /**
     * Adds to registry
     *
     * @param string $key key
     *
     * @param array $data data
     */
    public function addToRegistry($key, array $data)
    {
        $this->registry[$key] = $data;
    }

    /**
     * Runs application
     *
     * @param array $request
     *
     * @return void
     */
    public function web(array $request)
    {
        try {
            $uri = $this->registry['server']['REQUEST_URI'];
            $uri = explode('?', $uri);
            list($uri) = $uri;
            $route = $this->router->match($uri, $this->registry['server']['REQUEST_METHOD']);

            $controller = $this->locator[$route['controller']];

            $response = call_user_func_array([$controller, $route['action']], [$request]);

            $code = $response->getCode();
            $headers = $response->getHeaders();

            $tpl = null;
            if (isset($route['template'])) {
                $tpl = 'resources/view/' . $route['template'];
            }

            $context = $route['context'];
            $headers = array_merge($headers, $this->context->getHeaders($context));

            http_response_code($code);
            foreach ($headers as $key => $header) {
                header("$key: $header");
            }
            file_put_contents("php://output", $this->context->content($response->getContent(), $context, $tpl));
        } catch (RouteNotFoundException $e) {
            http_response_code(Response::HTTP_CODE_NOT_FOUND);
        }
    }
}