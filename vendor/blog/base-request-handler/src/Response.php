<?php

namespace Blog\BaseRequestHandler;

/**
 * Class Request
 *
 * @package blog/base-request-handler
 */
final class Response
{
    /**
     * Defalut key for incorrect request
     */
    const MSG = 'message';

    /**
     * Http status "ok" code
     */
    const HTTP_CODE_OK = 200;

    /**
     * Http status redirect
     */
    const HTTP_CODE_REDIRECT = 302;

    /**
     * Http "bad request status" code
     */
    const HTTP_CODE_BAD_REQUEST = 400;

    /**
     * Http status "access denied" code
     */
    const HTTP_CODE_ACCESS_DENIED = 403;

    /**
     * Http status "access denied" code
     */
    const HTTP_CODE_NOT_FOUND = 404;

    /**
     * Http status "internal server error code"
     */
    const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;

    /**
     * Standard header 'location'
     */
    const HEADER_LOCATION = 'location';

    /**
     * Wrong code template
     *
     * @var string
     */
    private static $wrongCode = 'Http code %d doesn\'t exist';

    /**
     * Content
     *
     * @var array
     */
    private $content;

    /**
     * Headers
     *
     * @var array
     */
    private $headers = [];

    /**
     * Code
     *
     * @var int
     */
    private $code;

    /**
     * Gets possible response codes
     *
     * @return array
     */
    private static $codes = [
        self::HTTP_CODE_OK,
        self::HTTP_CODE_BAD_REQUEST,
        self::HTTP_CODE_ACCESS_DENIED,
        self::HTTP_CODE_NOT_FOUND,
        self::HTTP_CODE_INTERNAL_SERVER_ERROR,
        self::HTTP_CODE_REDIRECT
    ];


    /**
     * Sets http code
     *
     * @param int $code HTTP code
     */
    public function setCode($code)
    {
        if (!in_array($code, static::$codes)) {
            throw new \RuntimeException(sprintf(static::$wrongCode, $code));
        }
        $this->code = $code;
    }

    /**
     * Sets content
     *
     * @param array $content content
     */
    public function setContent(array $content)
    {
        $this->content = $content;
    }

    /**
     *
     * @param array $headers headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers += $headers;
    }

    /**
     * Gets content
     *
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Gets headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Gets code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

}