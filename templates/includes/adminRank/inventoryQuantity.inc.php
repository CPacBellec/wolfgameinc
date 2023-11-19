<?php
use wolfpac\Wolfgameinc\Controller\ProductController;
$product = new ProductController();
$products = $product->getProductById($_GET['id']);
$labels = [ 'Quantiter'];
$inputs = [
    ['id'=>'quantity','name'=>'quantity','type'=>'number','placeholder'=>'Entrez la quantiter','required'=>false,'min'=>0,'max'=>100,'value'=>$products['quantity']],
];

fromTool('formulaire');
buildForm('Modifier la quantiter',$labels, $inputs,"Envoyer",'POST','#');

if(isset($_POST['submit'])){
    if($product->updateProductQuantity($_POST['quantity'])){
        header('Location: ./?page=adminMod&layout=html&adminMod=inventory');
        exit;
    }
}
?>