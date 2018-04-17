<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;


class MenuManager extends EntityManager
{
    const TABLE = 'menus';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function findAll()
    {
        return $this->conn->query('SELECT * FROM ' . $this->table, \PDO::FETCH_ASSOC)->fetchAll();
    }
}