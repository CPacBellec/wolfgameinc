<?php
use Wolfpac\Wolfgameinc\Controller\OrderController;
use Wolfpac\Wolfgameinc\Controller\Database;
$commands = new OrderController();
$database = new Database('wolfgameinc');
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