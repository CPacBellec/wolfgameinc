<?php
use wolfpac\Wolfgameinc\Controller\ProductController;
use wolfpac\Wolfgameinc\Controller\Database;
$product = new ProductController();
$database = new Database('wolfgameinc');
//recuperer les categories
$categories = [];
$statement = $database->table('category')->get([])->do();
while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
    $categories[$line['id']] = $line['name'];
}

$labels = ['Nom','Catégorie', 'Image' , 'Quantiter','Prix','Mise en avant','Description'];
$inputs = [
    ['id'=>'name','name'=>'name','type'=>'text','placeholder'=>'Entrez le nom du produit','required'=>true],
    ['id'=>'category','name'=>'category','type'=>'select','placeholder'=>'','required'=>false,'option'=>$categories],
    ['id'=>'picture','name'=>'picture','type'=>'file','required'=>true],
    ['id'=>'quantity','name'=>'quantity','type'=>'number','placeholder'=>'Entrez la quantité','required'=>true,'min'=>0,'max'=>100],
    ['id'=>'price','name'=>'price','type'=>'input','placeholder'=>'Entrez votre prix','required'=>true],
    ['id'=>'first','name'=>'first','type'=>'checkbox','required'=>true],
    ['id'=>'description','name'=>'description','type'=>'textarea','required'=>false],
];

fromTool('formulaire');

buildForm('Ajouter un produit',$labels, $inputs,"Envoyer",'POST','#');
if(isset($_POST['submit'])){
    
    if($_POST['first'] === 'on'){
        $_POST['first'] = 1;
    }else{
        $_POST['first'] = 0;
    }
    
    $fileContent = file_get_contents($_FILES['picture']['tmp_name']);
    $fileContent = $database->getEscaping( $fileContent);
    
    if($product->createProduct($_POST['name'],$_POST['category'],floatval($_POST['price']),$fileContent,$_POST['quantity'],$_POST['first'],isset($_POST['description'])?$_POST['description']:"")){
        header('Location: ./?page=adminMod&layout=html&adminMod=product');
        exit;
    }
}
?>