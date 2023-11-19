<?php
namespace wolfpac\Wolfgameinc\Controller;

use wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class PasswordController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }
    
    public function updatePassword(int $id,$email,string $oldPassword,string $password,string $password2) {
        $statement = $this->db->table('user')->get(["filters" => ['id' =>$id,'email'=>$email]])->do();
        while($line = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[]=$line;
        }
        $hashed_password = password_verify($oldPassword, $data[0]['password']);
        if(!$hashed_password){
            echo '<div class="row">';
            echo '<div class="container rounded bg-danger col-7">';
            echo "<div class='col-5 mx-auto text-center'>Votre mot de passe est incorrect. Veuillez vérifier votre mot de passe et réessayer.</div>";
            echo "</div>";
            echo "</div>";
            return false;
        }else if($password !== $password2){
            echo '<div class="row">';
            echo '<div class="container rounded bg-danger col-7">';
            echo "<div class='col-5 mx-auto text-center'>Votre mot de passe est incorrect. Veuillez vérifier votre mot de passe et réessayer.</div>";
            echo "</div>";
            echo "</div>";
            return false;
        }else{
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            try{
                $this->db->table('user')->update(['post' => ["password" => $hashed_password], "filters" => ['id' => $id,'email'=>$email]])->do();
            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
            return  true;
        }
    }
}
