<?php
use wolfpac\Wolfgameinc\Controller\ProductController;
$product = new ProductController();
if(isset($_GET['id'])){
    $status = $product->deleteProduct($_GET['id']);
    if($status){  
        dd('ok'); 
        header('Location: ./?page=adminRank&layout=html&adminRank=product');
        exit;
    }
}
?>