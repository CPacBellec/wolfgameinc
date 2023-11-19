<?php 
    use Adam\BoutiqueNws\Controller\AddressController;
    if(!isset($_SESSION['user'])) {
        header("Location: ./?page=login&layout=html");
        exit;
    }
    if(isset($_POST['submit'])){
        $signup = new AddressController();
        if($signup->updateAddress($_SESSION['user'],$_SESSION['user_email'],isset($_POST['address'])?$_POST['address']:'')){
            $_SESSION['user_address'] = $_POST['address'];
            header('Location: ./?page=profil&layout=html');
            exit;
        }
    }
   