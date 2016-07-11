<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 04.07.16
 * Time: 23:45
 */

namespace Blog\BlogComponent\Implementation;

use Blog\BlogComponent\BlogComment;
use Blog\Db\Db;

/**
 * Class BlogCommentImplementation
 *
 * @package blog/blog-component
 */
class BlogCommentImplementation implements BlogComment
{

    /**
     * checkFields($fields)
     */
    use FieldsChecker;

    /**
     * Security user mapper
     *
     * @var array
     */
    protected $mapper = [
        'table'  => 'blog_comment',
        'fields' => [
            'id' => 'id',
            'author' => 'author',
            'comment' => 'comment',
            'date'    => 'date',
            'post_id' => 'post_id'
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
    public function getComments($postId, $start, $number, array $fields)
    {
        $this->checkFields($fields);

        $comments = $this->db->select(

            $this->dbConnectionName,//connect

            $this->mapper, // mapper,

            $fields, // fields

            [['post_id', 'equals', $postId]], //conditions

            [['id', 'desc']], // order by

            [$start, $number] // limit
        );

        return $comments;
    }

    /**
     * {@inheritdoc}
     */
    public function createComment($postId, array $comment)
    {
        $comment['post_id'] = $postId;
        $this->checkFields(array_keys($comment));
        $this->db->insert(

            $this->dbConnectionName,

            $this->mapper,

            $comment
        );
    }
}