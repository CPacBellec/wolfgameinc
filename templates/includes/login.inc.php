<?php   
    use Adam\BoutiqueNws\Controller\LoginController;
    if(isset($_SESSION['user'])) {
        header("Location: ./?page=accueil&layout=html");
        exit;
    }
    if(isset($_POST['submit'])){
        $login = new loginController();
        if($login->checkUser($_POST['email'],$_POST['password'])){
            header('Location: ./?page=accueil&layout=html');
            exit;
        }
    }