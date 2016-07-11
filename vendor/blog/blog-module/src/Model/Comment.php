<?php

namespace Blog\BlogModule\Model;

/**
 * Interface Comment
 *
 * @package blog/blog-module
 */
interface Comment
{

    /**
     * Gets comments
     *
     * @param int $postId post ID
     *
     * @param int $start start of collection
     *
     * @param int $number post number
     *
     * @param array $fields gets comments list
     *
     * @return array
     */
    public function getList($postId, $start, $number, array $fields);

    /**
     * Creates comment
     *
     * @param int $postId post ID
     *
     * @param array $comment post data
     *
     * @return void
     */
    public function create($postId, array $comment);
}