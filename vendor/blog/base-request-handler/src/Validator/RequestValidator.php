<?php

namespace Blog\BaseRequestHandler\Validator;

/**
 * Interface RequestValidator
 *
 * @package blog/base-request-handler
 */
interface RequestValidator
{

    /**
     * Integer data type
     */
    const TYPE_INT = 'int';

    /**
     * String with short limited characters
     */
    const TYPE_STRING = 'string';

    /**
     * String with long limited characters
     */
    const TYPE_TEXT = 'text';

    /**
     * String is restricted by regexp
     */
    const TYPE_SIMPLE_STRING = 'simple_string';

    /**
     * Validates value of key element provided by request array
     *
     * @param string $key key
     *
     * @param string $type type
     *
     * @param array $reqeust request
     *
     * @return mixed
     */
    public function validate($key, $type, array $reqeust);

}