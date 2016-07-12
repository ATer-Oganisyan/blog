<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 03.07.16
 * Time: 15:25
 */

namespace Blog\SecurityComponent\Implementation;

use Blog\SecurityComponent\Auth;
use Blog\SecurityComponent\Exception\WrongCredentionalsException;
use Blog\SecurityComponent\Exception\UndefinedCredentionalsException;
use Blog\Db\Db;

/**
 * Class BasicAuth
 *
 * @package blog/securit-component
 */
class BasicAuth implements Auth
{
    /**
     *
     * user status enabled
     */
    const USER_STATUS_ENEABLED = 1;

    /**
     * Security user mapper
     *
     * @var array
     */
    protected $mapper = [
        'table'  => 'security_user',
        'fields' => [
            'id' => 'id',
            'full_name' => 'full_name',
            'nick_name' => 'nick_name',
            'login'     => 'login',
            'password'  => 'password',
            'status_id' => 'status_id'
        ]
    ];

    /**
     * DB connection name
     *
     * @var string
     */
    protected $dbConnectionName;

    /**
     * Interface to DB
     *
     * @var Db
     */
    protected $db;


    /**
     * BasicAuth constructor.
     *
     * @param Db $db db component
     *
     * @param string $dbConnectionName db connection name
     */
    public function __construct(Db $db, $dbConnectionName = 'default')
    {
        $this->db = $db;
        $this->dbConnectionName = $dbConnectionName;
    }

    /**
     * @inheritdoc
     */
    public function getUser($id)
    {
        $users = $this->db->select(

            $this->dbConnectionName, //connect

            $this->mapper, // mapper

            $this->mapper['fields'],

            [ // conditions
                ['id', 'equals', $id],
                ['status_id', 'equals', self::USER_STATUS_ENEABLED]
            ]
        );

        if ($users['result'] > []) {
            list($user) = $users['result'];
            return $user;
        }

        return [];
    }

    /**
     * @inheritdoc
     */
    public function getUsers(array $userIds)
    {
        return $this->db->select(

            $this->dbConnectionName, //connection

            $this->mapper, // mapper

            array_keys($this->mapper['fields']),

            [ //conditions
                ['id', 'in', $userIds],
                ['status_id', 'equals', self::USER_STATUS_ENEABLED]
            ]

        );
    }

    /**
     * @inheritdoc
     */
    public function auth(array $credentionals)
    {
        if (!isset($credentionals['login']) || !$credentionals['password']) {
            throw new UndefinedCredentionalsException();
        }

        $users = $this->db->select(

            $this->dbConnectionName, //connect

            $this->mapper, // mapper

            array_keys($this->mapper['fields']),

            [ // conditions
                ['login', 'equals', $credentionals['login']],
                ['password', 'equals', sha1($credentionals['password'])],
                ['status_id', 'equals', self::USER_STATUS_ENEABLED]
            ]

        );

        if ($users['count'] !== 1) {
            throw new WrongCredentionalsException();
        }

        list($user) = $users['result'];
        return $user;
    }
}