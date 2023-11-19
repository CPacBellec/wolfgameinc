<?php
namespace wolfpac\Wolfgameinc\Controller;

use wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class AddressController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }
    
    public function updateAddress(int $id,string $email,string $address) {
        try {
            $this->db->table('user')->update(['post' => [ "address" => $address], "filters" => ['id' => $id,'email'=>$email]])->do();
            return true;
        }catch(\Exception $e) { 
            return false;
        }
    }
}
