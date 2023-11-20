<?php
namespace Wolfpac\Wolfgameinc\Controller;

use Wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class CategoryController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }

    public function createCategory(string $name) {
        try {
            $this->db->table('category')->post(['post' => ["name" => $name]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }
    
    public function getAllCategory(){
        $statement = $this->db->table('category')->get([])->do();
        $categories = [];
        while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $line;
        }
        return $categories;
    }

   
    public function getCategoryById(int $id){
        $statement = $this->db->table('category')->get(['filters'=>['id'=>$id]])->do();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category['name'];
    }
   
}