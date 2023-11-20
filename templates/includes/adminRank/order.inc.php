<?php
use Wolfpac\Wolfgameinc\Controller\OrderController;
use Wolfpac\Wolfgameinc\Controller\ProductController;
use Wolfpac\Wolfgameinc\Controller\UserController;
$orderController = new OrderController();
$userController = new UserController();
$productController = new ProductController();
$orders = $orderController->getAllOrder();
$columns = ['Id Commande','Nom utilisateur', 'Email', 'Id Produit', 'Produit','Status','Date', 'Action'];
$table = [];
$data = [];
foreach($orders as $order){
    $user = $userController->getUserById($order['user_id']);
    $product = $productController->getProductById($order['product_id']);
    $status = $orderController->getStatusById($order['status_id']);
    $data[] = [
        'Id Commande' => $order['id'],
        'Nom utilisateur' => $user['lastname'].' '.$user['name'],
        'Email' => $user['email'],
        'Id Produit' => $order['product_id'],
        'Produit' => $product['name'],
        'Status' => $status['name'],
        'Date' => $order['date'],
        'action'=> true,
        'actionButton'=>
        [
            ['url'=>'./?page=adminRank&layout=html&adminRank=statusOrder&id='.$order['id'],'icon'=>'bi bi-pencil-square'],
            ['url'=>'./?page=orderDetail&layout=html&id='.$order['id'],'icon'=>'bi bi-eye'],
        ],
    ];
}
fromTool('table');
generateTable($data, $columns);