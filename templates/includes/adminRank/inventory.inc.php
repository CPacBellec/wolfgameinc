<?php
use Wolfpac\Wolfgameinc\Controller\ProductController;
$productController = new ProductController();
$products = $productController->getProductByFilters(['online'=>true]);
$columns = ['Id','Nom', 'Quantité', 'Catégorie', 'Prix', 'Action'];
$table = [];
$data = [];
foreach($products as $product){
    $data[] = [
        'Id' => $product['id'],
        'Nom' => $product['name'],
        'Quantité' => $product['quantity'],
        'Catégorie' => $productController->getCategoryById($product['category_id']),
        'Prix' => $product['price'],
        'action'=> true,
        'url' => './?page=adminRank&layout=html&adminRank=inventoryQuantity&id='. $product['id'],
        'icon' => 'bi bi-pencil-square',
    ];

}
fromTool('table');
generateTable($data, $columns);