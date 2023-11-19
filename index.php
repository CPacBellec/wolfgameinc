<?php
require 'vendor/autoload.php';
require_once './configs/bootstrap.php';
session_start();
ob_start();

$argumentGet = ["page", "layout", "product", "id", "category"];

if(isset($_SESSION['user_rank']) && $_SESSION['user_rank'] === 1) {
    $argumentGet[] = "adminRank";
}
if(isset($_GET["adminRank"])){
    if($_GET["page"]  !== 'adminRank' || fromAdminRank($_GET['adminRank'] === false)){
    header('Location: ./?page=home&layout=html');
    exit;
    }
}
$extraKeys = array_diff(array_keys($_GET), $argumentGet);
if (!empty($extraKeys)) {
    header('Location: ./?page=home&layout=html');
    exit;
}

if(isset($_GET["page"]) ){
    if(fromPage($_GET['page']) === false){
        header('Location: ./?page=home&layout=html');
    };
}else{
    header('Location: ./?page=home&layout=html');
    exit;
}
$pageContent = [
    "html" => ob_get_clean(),
];
if(isset($_GET["layout"])){
    include "./templates/layouts/". $_GET["layout"] .".layout.php";

}else{
    include "./templates/layouts/html.layout.php";
}