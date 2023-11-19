<?php
namespace wolfpac\Wolfgameinc\Controller;

use wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class OrderController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }

    public function createOrder(int $user_id,int $product_id,int $status_id) {
        $date =$date = date("Y-m-d H:i");
        try {
            $this->db->table('orders')->post(['post' => ["date" => $date,"user_id"=>$user_id,"product_id"=>$product_id,"status_id"=>$status_id]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }
    public function updateOrder(int $status_id) {
        
        try {
            $this->db->table('orders')->update(['filters'=>['id'=>$_GET['id']],'post' => ["status_id"=>$status_id]])->do();
            return true;
        }catch(\Exception $e) {
            return false;
        }
    }
    public function getAllOrder(){
        $statement = $this->db->table('orders')->get([])->do();
        $Commands = [];
        while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
            $commands[] = $line;
        }
        return $commands;
    }
    public function getOrderById(int $id){
        $statement = $this->db->table('orders')->get(['filters'=>['id'=>$id]])->do();
        $command = $statement->fetch(PDO::FETCH_ASSOC);
        return $command;
    }
    public function getOrderByUser(int $user_id){
        $statement = $this->db->table('orders')->get(['filters'=>['user_id'=>$user_id]])->do();
        while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
            $command[] = $line;
        }
        if(isset($command)){
            return $command;
        }else{
            return [];
        }
    }
    public function getStatusById(int $id){
        $statement = $this->db->table('statusOrder')->get(['filters'=>['id'=>$id]])->do();
        $status = $statement->fetch(PDO::FETCH_ASSOC);
        return $status;
    }
   
}