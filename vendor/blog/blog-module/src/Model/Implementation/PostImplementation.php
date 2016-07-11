<?php

namespace Blog\BlogModule\Model\Implementation;

use Blog\BlogComponent\BlogPost;
use Blog\BlogModule\Model\Post;
use Blog\SecurityComponent\Security;
use Blog\SecurityComponent\Exception\NotAuthenticatedException;

/**
 * Class PostImplementation
 *
 * @package blog/blog-module
 */
class PostImplementation implements Post
{
    /**
     * Blog component
     *
     * @var BlogPost
     */
    protected $blog;

    /**
     * Securty component
     *
     * @var Security
     */
    protected $security;

    /**
     * PostImplementation constructor
     *
     * @param BlogPost $blog blog
     *
     * @param Security $security security
     */
    public function __construct(BlogPost $blog, Security $security)
    {
        $this->security = $security;
        $this->blog = $blog;
    }

    /**
     * @inheritdoc
     */
    public function getList($start, $number, array $fields)
    {
        $list = $this->blog->getPosts($start, $number, $fields);
        $list = $this->bindListWithUsers($list);
        return $list;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        $post = $this->blog->getPost($id);
        if ($post['result']) {
            list($post) = $post['result'];
            $post['user'] = $this->security->getUser($post['user_id']);
        }

        return $post;
    }

    /**
     * @inheritdoc
     */
    public function create(array $post)
    {
        if (!($user = $this->security->getUser())) {
            throw new NotAuthenticatedException('Not authenticated user');
        }
        $post['user_id'] = $user['id'];
        $this->blog->createPost($post);
    }

    /**
     * Binds each element of list with it's user
     *
     * @param array $list post list
     *
     * @return array
     */
    protected function bindListWithUsers(array $list)
    {
        $userIds = [];
        foreach ($list['result'] as $post) {
            $userIds[] = $post['user_id'];
        }

        $users = $this->security->getUsers($userIds);
        $users = $this->index('id', $users['result']);

        foreach ($list['result'] as &$post) {
            $post['user'] = $users[$post['user_id']];
        }

        return $list;
    }

    /**
     * Index by field
     *
     * @param string $field field
     *
     * @param array $array array
     *
     * @return array
     */
    protected function index($field, $array)
    {
        $out = [];
        foreach ($array as $row) {
            $out[$row[$field]] = $row;
        }

        return $out;
    }

}