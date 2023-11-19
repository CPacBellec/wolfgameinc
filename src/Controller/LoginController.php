<?php
namespace wolfpac\Wolfgameinc\Controller;

use wolfpac\Wolfgameinc\Controller\Database;
use PDO;

class LoginController {
    private $db;
    
    public function __construct() {
        $this->db = new Database('wolfgameinc');
    }
    
    public function checkUser(string $email,string $password) {
        $statement = $this->db->table('user')->get(["filters" => ['email' =>$email]])->do();
        while($line = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[]=$line;
        }
        if(!isset($data)){
            echo '<div class="row">';
            echo '<div class="container rounded bg-danger col-7">';
            echo "<div class='col-5 mx-auto text-center'>Vos informations de connexion sont incorrectes. Veuillez vérifier votre email et votre mot de passe, puis réessayer.</div>";
            echo "</div>";
            echo "</div>";
            return false;
        }
        $hashed_password = password_verify($password, $data[0]['password']);
        if(isset($data) && $hashed_password){
            $_SESSION['user_name'] = $data[0]['name'];
            $_SESSION['user_lastname'] = $data[0]['lastname'];
            $_SESSION['user_email'] = $data[0]['email'];
            $_SESSION['user_address'] = $data[0]['address'];
            $_SESSION['user_role'] = $data[0]['role'];
            $_SESSION['user'] = $data[0]['id'];
            return true;
        }else{
            echo '<div class="row">';
            echo '<div class="container rounded bg-danger col-7">';
            echo "<div class='col-5 mx-auto text-center'>Vos informations de connexion sont incorrectes. Veuillez vérifier votre email et votre mot de passe, puis réessayer.</div>";
            echo "</div>";
            echo "</div>";
            return false;
        }
    }
}