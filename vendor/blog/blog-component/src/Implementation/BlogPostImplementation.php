<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 1:31
 */

namespace Blog\BlogComponent\Implementation;

use Blog\BlogComponent\BlogPost;
use Blog\Db\Db;


/**
 * Class BlogPostImplementation
 *
 * @package blog/blog-component
 */
class BlogPostImplementation implements BlogPost
{

    /**
     * checkFields($fields)
     */
    use FieldsChecker;

    /**
     *
     * user status enabled
     */
    const POST_STATUS_ENEABLED = 1;

    /**
     * Security user mapper
     *
     * @var array
     */
    protected $mapper = [
        'table'  => 'blog_post',
        'fields' => [
            'id' => 'id',
            'title' => 'title',
            'content' => 'content',
            'user_id'     => 'user_id',
            'post_date'  => 'post_date',
            'status_id' => 'status_id',
        ]
    ];

    /**
     * Connection name
     *
     * @var string
     */
    protected $dbConnectionName;

    /**
     * Database component
     *
     * @var Db
     */
    protected $db;

    /**
     * BlogPostImplementation constructor
     *
     * @param string $dbConnectionName connection name
     *
     * @param Db $db database component
     */
    public function __construct(Db $db, $dbConnectionName = 'default')
    {
        $this->db = $db;
        $this->dbConnectionName = $dbConnectionName;
    }

    /**
     * {@inheritdoc}
     */
    public function getPost($id)
    {
        return $this->db->select(

            $this->dbConnectionName,

            $this->mapper,

            $this->mapper['fields'],

            [
                ['id', 'equals', $id],
                ['status_id', 'equals', self::POST_STATUS_ENEABLED]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getPosts($start, $number, array $fields)
    {
        $fields = array_merge($fields, ['user_id']);

        $this->checkFields($fields);

        $posts = $this->db->select(

            $this->dbConnectionName,//connect

            $this->mapper, // mapper

            $fields, // fields

            [], //conditions

            [['id', 'desc']], // order by

            [$start, $number] // limit
        );

        return $posts;
    }

    /**
     * {@inheritdoc}
     */
    public function createPost(array $post)
    {
        $this->checkFields(array_keys($post));
        $this->db->insert(

            $this->dbConnectionName,

            $this->mapper,

            $post
        );
    }

}