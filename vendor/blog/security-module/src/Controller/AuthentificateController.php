<?php

namespace Blog\SecurityModule\Controller;

use Blog\BaseRequestHandler\Controller;
use Blog\BaseRequestHandler\Response;
use Blog\BaseRequestHandler\Validator\Exception\RequestValidatorException;
use Blog\BaseRequestHandler\Validator\RequestValidator;
use Blog\SecurityModule\Model\Security;

/**
 * Class AuthentificateController
 *
 * @package blog/security-module
 */
class AuthentificateController extends Controller
{
    /**
     * Config
     *
     * @var array
     */
    private $config;

    /**
     * Security
     *
     * @var Security
     */
    private $security;

    /**
     * Validator
     *
     * @var RequestValidator
     */
    private $validator;


    /**
     * AuthentificateController constructor
     *
     * @param array $config controller config
     *
     * @param Security $security security
     *
     * @param RequestValidator $validator validator
     */
    public function __construct(array $config, Security $security, RequestValidator $validator)
    {
        $this->config = $config;
        $this->security = $security;
        $this->validator = $validator;
    }

    /**
     * Auth action
     *
     * @param array $request request
     *
     * @return Response
     */
    public function authAction(array $request)
    {
        try {

            if (!isset($request['auth'])) {
                return $this->response(

                );
            }

            $login = $this->validator->validate('login', RequestValidator::TYPE_STRING, $request);
            $password = $this->validator->validate('password', RequestValidator::TYPE_STRING, $request);

            if ($this->security->auth($this->config['auth_type'], ['login' => $login, 'password' => $password])) {
                return $this->response(
                    [],
                    Response::HTTP_CODE_REDIRECT,
                    [Response::HEADER_LOCATION => $this->config['auth_redirect']]
                );
            }

            return $this->response(['success' => false]);

        } catch (RequestValidatorException $e) {
            return $this->response(['success' => false, Response::HTTP_CODE_BAD_REQUEST]);
        }
    }

    /**
     * Gets current user
     *
     * @return Response
     */
    public function getCurrentUserAction()
    {
        return $this->response(
            ['user' => $this->security->getUser()]
        );
    }

}