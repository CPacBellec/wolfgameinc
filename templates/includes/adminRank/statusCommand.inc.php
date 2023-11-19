<?php
use wolfpac\Wolfgameinc\Controller\OrderController;
use wolfpac\Wolfgameinc\Controller\Database;
$commands = new OrderController();
$database = new Database('BoutiqueSC');
$status = [];
$statement = $database->table('statusOrder')->get([])->do();
while ($line = $statement->fetch(PDO::FETCH_ASSOC)) {
    $status[$line['id']] = $line['name'];
}

$order = $orders->getOrderById($_GET['id']);

$labels = ['Status'];
$inputs = [
    ['id'=>'status','name'=>'status','type'=>'select','placeholder'=>'','required'=>false,'option'=>$status,'value'=>$command['status_id']],
];

fromTool('formulaire');

buildForm('Modifier le statu',$labels, $inputs,"Envoyer",'POST','#');
if(isset($_POST['submit'])){
    if($orders->updateOrder($_POST['status'])){
        header('Location: ./?page=adminRank&layout=html&adminRank=commands');
        exit;
    }
}
?>