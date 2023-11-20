<?php
namespace Wolfpac\Wolfgameinc\Controller;

class SignoutController {
    
    public function signout($login = false) {
        if($login) {
            session_destroy();
            header("Location: ./?page=login&layout=html");
            exit();
        }else {
            session_destroy();
            header("Location: ./?page=accueil&layout=html");
            exit();
        }
    }
}
