<?php

namespace Blog\BlogModule\Model\Implementation;

use Blog\BlogModule\Model\Comment;
use Blog\BlogComponent\BlogComment;

/**
 * Class CommentImplementation
 *
 * @package blog/blog-module
 */
class CommentImplementation implements Comment
{

    /**
     * Blog component
     *
     * @var BlogComment
     */
    protected $blog;

    /**
     * CommentImplementation constructor
     *
     * @param BlogComment $blog blog
     */
    public function __construct(BlogComment $blog)
    {
        $this->blog = $blog;
    }

    /**
     * {@inheritdoc}
     */
    public function getList($postId, $start, $number, array $fields)
    {
        return $this->blog->getComments($postId, $start, $number, $fields);
    }

    /**
     * {@inheritdoc}
     */
    public function create($postId, array $comment)
    {
        $this->blog->createComment($postId, $comment);
    }

}