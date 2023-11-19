<?php 
    use Adam\BoutiqueNws\Controller\SignupController;
    if(isset($_SESSION['user'])) {
        header("Location: ./?page=accueil&layout=html");
        exit;
    }
    if(isset($_POST['submit'])){
        $signup = new SignupController();
        if($signup->createUser($_POST['name'],$_POST['lastname'],$_POST['email'],isset($_POST['address'])?$_POST['address']:'',$_POST['password'],$_POST['password2'])){
            header('Location: ./?page=login&layout=html');
            exit;
        }
    }
   