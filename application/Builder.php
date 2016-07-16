<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 10.07.16
 * Time: 10:57
 */

namespace Blog\BlogApplication;

use Blog\BaseRequestHandler\Validator\Implementation\IntValidator;
use Blog\BaseRequestHandler\Validator\Implementation\RequestValidatorImplementation;
use Blog\BaseRequestHandler\Validator\Implementation\StringValidator;
use Blog\BlogComponent\Implementation\BlogCommentImplementation;
use Blog\BlogComponent\Implementation\BlogPostImplementation;
use Blog\BlogModule\Controller\CommentController;
use Blog\BlogModule\Controller\PostController;
use Blog\Db\Implementation\DbImplementation;
use Blog\Db\Implementation\PdoMysql;
use Blog\Db\Implementation\Sql;
use Blog\SecurityComponent\Implementation\BasicAuth;
use Blog\SecurityComponent\Implementation\SecurityImplementation;
use Blog\SecurityComponent\Implementation\Session;
use Blog\SecurityModule\Controller\AuthenticateController;
use Blog\BlogModule\Model\Implementation\CommentImplementation;
use Blog\BlogModule\Model\Implementation\PostImplementation;
use Blog\SecurityModule\Model\Implementation\SecurityImplementation as SecurityModel;

/**
 * Class Builder
 *
 * @package blog/blog-application
 */
class Builder
{
    /**
     * Config
     *
     * @var array
     */
    protected $config;

    /**
     * Builder constructor.
     *
     * @param array $confing config
     */
    public function __construct(array  $config)
    {
        $this->config = $config;
    }

    /**
     * Gets locator
     *
     * @return array
     */
    public function getLocator()
    {
        $c = $this->config;

        $db = new DbImplementation($c['db_connections'], new PdoMysql, new Sql);

        $validator = new RequestValidatorImplementation();
        $validator->addDataTypeValidator(new IntValidator(), 'int');
        $validator->addDataTypeValidator( new StringValidator($c['modules']['blog']['string_length']), 'string');
        $validator->addDataTypeValidator(
            new StringValidator($c['modules']['blog']['string_length'], $c['modules']['blog']['simple_string_regexp']),
            'simple_string'
        );
        $validator->addDataTypeValidator(new StringValidator($c['modules']['blog']['text_length']), 'text');

        session_start();
        $storage = new Session($_SESSION);

        $security = new SecurityImplementation($storage, $c['security']['refersh_user_by_every_request']);
        $security->addAuthentificatot('basic', new BasicAuth($db));

        $postComponent = new BlogPostImplementation($db, $c['modules']['blog']['db_connection']);

        $commentComponent = new BlogCommentImplementation($db, $c['modules']['blog']['db_connection']);

        $postModel = new PostImplementation($postComponent, $security);

        $commentModel = new CommentImplementation($commentComponent);

        $securityModel = new SecurityModel($security);

        $postController = new PostController($c['modules']['blog'], $validator, $postModel);
        $commentController = new CommentController($c['modules']['blog'], $commentModel, $validator);
        $authController = new AuthenticateController($c['security'], $securityModel, $validator);

        return [
            'post'    => $postController,
            'comment' => $commentController,
            'auth'    => $authController,
        ];
    }
}