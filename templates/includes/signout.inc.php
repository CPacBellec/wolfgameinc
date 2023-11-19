<?php 
use Adam\BoutiqueNws\Controller\SignoutController;
if(!isset($_SESSION['user'])) {
    header("Location: ./?page=login&layout=html");
    exit;
}
$signout = new SignoutController();
$signout->signout();