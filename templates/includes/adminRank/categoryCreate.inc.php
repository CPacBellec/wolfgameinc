<?php
use Wolfpac\Wolfgameinc\Controller\CategoryController;
$categorys = new CategoryController();
$labels = [ 'Catégorie'];
$inputs = [
    ['id'=>'category','name'=>'category','type'=>'text','placeholder'=>'Entrez la categorie','required'=>true],
];

fromTool('formulaire');
buildForm('Ajouter une categorie',$labels, $inputs,"Envoyer",'POST','#');

if(isset($_POST['submit'])){
    if($categorys->createCategory($_POST['category'])){
        header('Location: ./?page=adminRank&layout=html&adminRank=category');
        exit;
    }
}
?>