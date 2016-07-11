<?php

namespace Blog\BlogComponent;

/**
 * Interface BlogPost
 *
 * @package blog/blog-component
 */
interface BlogPost
{
    /**
     * Gets post list
     *
     * @param int $start start of diaposone
     *
     * @param int $number count of posts
     *
     * @param array $fields fields of post
     *
     * @return array
     */
    public function getPosts($start, $number, array $fields);

    /**
     * Gets post by ID
     *
     * @param int $id post ID
     *
     * @return mixed
     */
    public function getPost($id);

    /**
     * Creates post
     *
     * @param array $post post
     *
     * @return void
     */
    public function createPost(array $post);
}