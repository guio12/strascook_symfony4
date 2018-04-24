<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 */

namespace Model;
use \PDO;

class LoginManager extends EntityManager
{
    const TABLE = 'login';


    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getLogin($username)
    {
        $statement = $this->conn->prepare("SELECT id, username, password FROM $this->table WHERE username = :username");
     
        $statement->bindValue(':username', $username);
        
        $statement->execute();

        //Fetch row.
        return $statement->fetch(PDO::FETCH_ASSOC);
  
    }

}