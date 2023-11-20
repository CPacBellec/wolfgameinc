<?php
use Wolfpac\Wolfgameinc\Controller\ProductController;
$product = new ProductController();
$products = $product->getProductById($_GET['id']);
$labels = [ 'Quantiter'];
$inputs = [
    ['id'=>'quantity','name'=>'quantity','type'=>'number','placeholder'=>'Entrez la quantité','required'=>false,'min'=>0,'max'=>100,'value'=>$products['quantity']],
];

fromTool('formulaire');
buildForm('Modifier la quantité',$labels, $inputs,"Envoyer",'POST','#');

if(isset($_POST['submit'])){
    if($product->updateProductQuantity($_POST['quantity'])){
        header('Location: ./?page=adminRank&layout=html&adminRank=inventory');
        exit;
    }
}
?>