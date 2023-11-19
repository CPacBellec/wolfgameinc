<?php
use wolfpac\Wolfgameinc\Controller\ProductController;
$productController = new ProductController();
$products = $productController->getProductByFilters(['online'=>true]);
$columns = ['Id','Nom', 'Quantiter', 'Catégorie', 'Prix', 'Action'];
$table = [];
$data = [];
foreach($products as $product){
    $data[] = [
        'Id' => $product['id'],
        'Nom' => $product['name'],
        'Quantiter' => $product['quantity'],
        'Catégorie' => $productController->getCategoryById($product['category_id']),
        'Prix' => $product['price'],
        'action'=> true,
        'url' => './?page=adminMod&layout=html&adminMod=inventoryQuantity&id='. $product['id'],
        'icon' => 'bi bi-pencil-square',
    ];

}
fromTool('table');
generateTable($data, $columns);