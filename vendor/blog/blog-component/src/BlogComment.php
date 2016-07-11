<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 02.07.16
 * Time: 19:03
 */

namespace Blog\BlogComponent;

/**
 * Interface BlogComment
 *
 * @package blog/blog-component
 */
interface BlogComment
{
    /**
     * Gets post list
     *
     * @param int $postId ID of post
     *
     * @param int $start start of diaposone
     *
     * @param int $number count of posts
     *
     * @param array $fields fields of post
     *
     * @return array
     */
    public function getComments($postId, $start, $number, array $fields);

    /**
     * Creates comment
     *
     * @param int $postId post ID
     *
     * @param array $comment comment
     *
     * @return mixed
     */
    public function createComment($postId, array $comment);
}