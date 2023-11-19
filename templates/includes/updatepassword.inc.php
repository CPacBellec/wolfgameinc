<?php 
    use Adam\BoutiqueNws\Controller\PasswordController;
    use Adam\BoutiqueNws\Controller\SignoutController;
    if(!isset($_SESSION['user'])) {
        header("Location: ./?page=login&layout=html");
        exit;
    }
    if(isset($_POST['submit'])){
        $signup = new PasswordController();
        if($signup->updatePassword($_SESSION['user'],$_SESSION['user_email'],$_POST['oldpassword'],$_POST['password'],$_POST['password2'])){
            $signout = new SignoutController();
            $signout->signout(true);
        }
    }
   