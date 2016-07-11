<?php

namespace Blog\BlogModule\Controller;

use Blog\BaseRequestHandler\Validator\Exception\RequestValidatorException;
use Blog\BaseRequestHandler\Validator\RequestValidator;
use Blog\BaseRequestHandler\Controller;
use Blog\BaseRequestHandler\Response;
use Blog\SecurityComponent\Exception\NotAuthenticatedException;
use Blog\BlogModule\Model\Post;


/**
 * Class PostController
 *
 * @package blog/blog-module
 */
class PostController extends Controller
{
    /**
     * Controller config
     *
     * @var array
     */
    protected $config;

    /**
     * Request config
     *
     * @var RequestValidator
     */
    protected $validator;

    /**
     * Post model
     *
     * @var Post
     */
    protected $model;

    /**
     * PostController constructor
     *
     * @param array $config config
     *
     * @param RequestValidator $validator
     *
     * @param Post $model post model
     */
    public function __construct(array $config, RequestValidator $validator, Post $model)
    {
        $this->config = $config;
        $this->validator = $validator;
        $this->model = $model;
    }

    /**
     * List
     *
     * @param array $request reuqets
     *
     * @return Response
     */
    public function listAction(array $request)
    {
        try {
            if (isset($request['start'])) {
                $start = $this->validator->validate('start', RequestValidator::TYPE_INT, $request);
            } else {
                $start = 0;
            }

            $number = $this->config['posts_num_per_page'];

            $list = $this->model->getList($start, $number, ['id', 'title', 'post_date']);

            return $this->response($list);

        } catch (RequestValidatorException $e) {

            return $this->response([Response::MSG => 'Invalid parameters'], Response::HTTP_CODE_BAD_REQUEST);

        }
    }

    /**
     * Show the post
     *
     * @param array $request request
     *
     * @return Response
     */
    public function showAction(array $request)
    {
        $r = new Response();
        $post = $this->model->get(
            $this->validator->validate('id', RequestValidator::TYPE_INT, $request)
        );

        if ($post) {
            return $this->response($post);
        }

        return $this->response([Response::MSG => 'Post is not found'], Response::HTTP_CODE_NOT_FOUND);
    }

    /**
     * Add post
     *
     * @param array $request request
     *
     * @return Response
     */
    public function addAction(array $request)
    {
        try {
            $title = $this->validator->validate('title', RequestValidator::TYPE_STRING, $request);
            $content = $this->validator->validate('content', RequestValidator::TYPE_TEXT, $request);
            $date = new \DateTime();

            $post = [
                'title' => $title,
                'content' => $content,
                'date' => $date->format('d.m.Y H:i:s'),
            ];

            $this->model->create($post);
            return $this->response();

        } catch (RequestValidatorException $e) {

            return $this->response([Response::MSG => 'Invalid parameters'], Response::HTTP_CODE_BAD_REQUEST);

        } catch (NotAuthenticatedException $e) {

            return $this->response([Response::MSG => $e->getMessage()], Response::HTTP_CODE_ACCESS_DENIED);

        }


    }

}