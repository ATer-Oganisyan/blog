<?php

namespace Blog\BlogModule\Controller;

use Blog\BlogModule\Model\Comment;
use Blog\BaseRequestHandler\Controller;
use Blog\BaseRequestHandler\Response;
use Blog\BaseRequestHandler\Validator\RequestValidator;
use Blog\BaseRequestHandler\Validator\Exception\RequestValidatorException;

/**
 * Class CommentController
 *
 * @package blog/blog-module
 */
class CommentController extends Controller
{
    /**
     * Controller config
     * 
     * @var array
     */
    private $config;

    /**
     * Comment model
     * 
     * @var Comment
     */
    private $model;

    /**
     * Request validator
     * 
     * @var RequestValidator
     */
    private $validator;

    /**
     * CommentController constructor
     * .
     * @param array $config config
     * 
     * @param Comment $model comment model
     * 
     * @param RequestValidator $validator validator
     * 
     * @return void
     */
    public function __construct(array $config, Comment $model, RequestValidator $validator)
    {
        $this->config = $config;
        $this->model = $model;
        $this->validator = $validator;
    }

    /**
     * List of comments
     * 
     * @param array $request request
     * 
     * @return Response
     */
    public function listAction(array $request)
    {
        try {
            if (!isset($request['start'])) {
                $start = 0;
            } else {
                $start = $this->validator->validate('start', RequestValidator::TYPE_INT, $request);
            }

            $postId = $this->validator->validate('post_id', RequestValidator::TYPE_INT, $request);
            $number = $this->config['comments_num_per_page'];
            $list = $this->model->getList($postId, $start, $number, ['id', 'comment', 'author', 'date']);

            return $this->response($list);

        } catch (RequestValidatorException $e) {

            return $this->response([Response::MSG => 'Invalid parameters'], Response::HTTP_CODE_BAD_REQUEST);

        }
    }

    /**
     * Adds comment
     * 
     * @param array $request request
     * 
     * @return Response
     */
    public function addAction(array $request)
    {
        try {
            $comment = $this->validator->validate('content', RequestValidator::TYPE_TEXT, $request);
            $author = $this->validator->validate('content', RequestValidator::TYPE_SIMPLE_STRING, $request);
            $postId = $this->validator->validate('postId', RequestValidator::TYPE_INT, $request);
            $date = new \DateTime();
            $comment = [
                'comment' => $comment,
                'author' => $author,
                'date' => $date->format('d.m.Y H:i:s'),
            ];
            $this->model->create($postId, $comment);
            return $this->response();

        } catch (RequestValidatorException $e) {
            return $this->response([Response::MSG => 'Invalid parameters'], Response::HTTP_CODE_BAD_REQUEST);
        }
    }

}