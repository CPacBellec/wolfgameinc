<?php
namespace Wolfpac\Wolfgameinc\Controller;

use Wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class UserController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }
    public function getUserById(int $id){
        $statement = $this->db->table('user')->get(['filters'=>['id'=>$id]])->do();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}