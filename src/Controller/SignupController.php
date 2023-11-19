<?php
namespace wolfpac\Wolfgameinc\Controller;

use wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class SignupController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }
    
    public function createUser(string $name,string $lastname,string $email,string $address,string $password,string $password2) {
        $statement = $this->db->table('user')->get(["filters" => ['email' =>$email],"cols"=>['email']])->do();
        while($line = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[]=$line;
        }
        if(isset($data) && count($data) > 0){
            echo '<div class="row">';
            echo '<div class="container rounded bg-danger col-7">';
            echo "<div class='col-5 mx-auto text-center'>L'adresse email que vous avez fournie est déjà associée à un compte.</div>";
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
                $this->db->table('user')->post(['post' => [ "name" => $name , "lastname" => $lastname, "email" => $email,"address" => $address,"password" => $hashed_password,"role" => 1]])->do(); 
            }catch(\Exception $e){
                echo $e->getMessage();
                return false;
            }
            return  true;
        }
    }
}
