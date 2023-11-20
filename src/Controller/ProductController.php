<?php
namespace Wolfpac\Wolfgameinc\Controller;

use Wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class ProductController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }

    public function createProduct(string $name,int $category,float $price,string $image,int $quantity,int $first,string $description = "") {
        $date =$date = date("Y-m-d H:i");
        try {
            $this->db->table('product')->post(['post' => ["name" => $name,"description" => $description,"price" => $price,"quantity" => $quantity,"image" => $image,"first" => $first,"date" => $date,"online" => true,"category_id"=>$category]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }
    public function updateProduct(string $name,int $category,float $price,string $image,int $quantity,int $first,string $description = "") {
        $date =$date = date("Y-m-d H:i");
        try {
            $this->db->table('product')->update(['post' => ["name" => $name,"description" => $description,"price" => $price,"quantity" => $quantity,"image" => $image,"first" => $first,"date" => $date,"online" => true,"category_id"=>$category],'filters'=>['id'=>$_GET['id']]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }
    public function deleteProduct(int $id) {
        try {
            $this->db->table('product')->delete(['filters'=>['id'=>$id]])->do();
            return true;
        }catch(\Exception $e) {
            echo $e;
            return false;
        }
    }
    public function updateProductQuantity(int $quantity) {
        try {
            $this->db->table('product')->update(['post' => ["quantity" => $quantity],'filters'=>['id'=>$_GET['id']]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }
    public function updateProductQuantityWithId(int $product_id) {
        $statement = $this->db->table('product')->get(['filters'=>['id'=>$product_id]])->do();
        $statement = $statement->fetch(PDO::FETCH_ASSOC);
        if($statement['quantity'] <= 0){
            return false;
        }
        try {
            $this->db->table('product')->update(['post' => ["quantity" => $statement['quantity']-1],'filters'=>['id'=>$product_id]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }

    public function getAllProducts(){
        $statement = $this->db->table('product')->get(['filters'=>['online'=>true]])->do();
        $products = [];
        while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $line;
        }
        return $products;
    }
    public function getProductByFilters(array $filters){
        $statement = $this->db->table('product')->get(['filters'=>$filters])->do();
        $products = [];
        while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $line;
        }
        return $products;
    }
    public function getCategoryById(int $id){
        $statement = $this->db->table('category')->get(['filters'=>['id'=>$id]])->do();
        $category = $statement->fetch(PDO::FETCH_ASSOC);
        return $category['name'];
    }
    public function getProductById(int $id){
        $statement = $this->db->table('product')->get(['filters'=>['id'=>$id]])->do();
        $product = $statement->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
   
}