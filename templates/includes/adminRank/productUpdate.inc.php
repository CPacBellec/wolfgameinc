<?php
use Wolfpac\Wolfgameinc\Controller\ProductController;
use Wolfpac\Wolfgameinc\Controller\Database;
$product = new ProductController();
$database = new Database('wolfgameinc');
$categories = [];
$statement = $database->table('category')->get([])->do();
while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
    $categories[$line['id']] = $line['name'];
}

$products = $product->getProductById($_GET['id']);

$labels = ['Nom','Catégorie', 'Image' , 'Quantité','Prix','Mise en avant','Description'];
$inputs = [
    ['id'=>'name','name'=>'name','type'=>'text','placeholder'=>'Entrez le nom du produit','required'=>false,'value'=>$products['name']],
    ['id'=>'category','name'=>'category','type'=>'select','placeholder'=>'','required'=>false,'option'=>$categories,'value'=>$products['category_id']],
    ['id'=>'picture','name'=>'picture','type'=>'file','required'=>false],
    ['id'=>'quantity','name'=>'quantity','type'=>'number','placeholder'=>'Entrez la quantiter','required'=>false,'min'=>0,'max'=>100,'value'=>$products['quantity']],
    ['id'=>'price','name'=>'price','type'=>'input','placeholder'=>'Entrez votre prix','required'=>false,'value'=>$products['price']],
    ['id'=>'first','name'=>'first','type'=>'checkbox','required'=>false,'value'=>$products['first']],
    ['id'=>'description','name'=>'description','type'=>'textarea','required'=>false,'value'=>$products['description']],
];

fromTool('formulaire');

buildForm('Modifier un produit',$labels, $inputs,"Envoyer",'POST','#');
if(isset($_POST['submit'])){
    if($_POST['first'] === 'on'){
        $_POST['first'] = 1;
    }else{
        $_POST['first'] = 0;
    }
    if(isset($_FILES['picture']['tmp_name']) && is_uploaded_file($_FILES['picture']['tmp_name']) && filesize($_FILES['picture']['tmp_name']) > 0){
        $fileContent = file_get_contents($_FILES['picture']['tmp_name']);
        $fileContent = $database->getEscaping( $fileContent);
    }else{
        $fileContent = $products['image'];
        $fileContent = $database->getEscaping( $fileContent);
    }
    
    if($product->updateProduct($_POST['name'],$_POST['category'],floatval($_POST['price']),$fileContent,$_POST['quantity'],$_POST['first'],$_POST['description'])){
        header('Location: ./?page=adminRank&layout=html&adminRank=product');
        exit;
    }
}
?>