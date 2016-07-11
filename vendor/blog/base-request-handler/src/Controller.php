<?php

namespace Blog\BaseRequestHandler;

/**
 * Class Controller
 *
 * @package blog/base-request-handler
 */
abstract class Controller
{
    /**
     * Sends reposnse
     *
     * @param array $content content
     *
     * @param int $code HTTP response status code
     *
     * @return Response
     */
    final protected function response(array $content = ['success' => true],
                                      $code = Response::HTTP_CODE_OK,
                                      array $headers = [])
    {
        $r = new Response();
        $r->setCode($code);
        $r->setHeaders($headers);
        $r->setContent($content);
        return $r;
    }
}