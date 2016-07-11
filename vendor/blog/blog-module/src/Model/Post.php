<?php

namespace Blog\BlogModule\Model;

/**
 * Interface Post
 *
 * @package blog/blog-module
 */
interface Post
{

    /**
     * @param int $start start of collection
     *
     * @param int $number post number
     *
     * @param array $fields gets post list
     *
     * @return array
     */
    public function getList($start, $number, array $fields);

    /**
     * Gets post by ID
     *
     * @param int $id ID of post
     *
     * @return array
     */
    public function get($id);

    /**
     * Creates post
     *
     * @param array $post post data
     *
     * @return void
     */
    public function create(array $post);
}