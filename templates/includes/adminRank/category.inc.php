<?php

use wolfpac\Wolfgameinc\Controller\CategoryController;
$categoryController = new CategoryController();
$categorys = $categoryController->getAllCategory();
$columns = ['Id' ,'Catégorie'];
$table = [];
$data = [];
foreach($categorys as $category){
    $data[] = [
        'Id' => $category['id'],
        'Catégorie' => $category['name'],
        'action'=> false,
    ];

}
fromTool('table');
generateTable($data, $columns);