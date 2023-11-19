<?php
use Adam\BoutiqueNws\Controller\ProductController;
use Adam\BoutiqueNws\Controller\CategoryController;
use Adam\BoutiqueNws\Controller\CommandController;
use Adam\BoutiqueNws\Controller\StatusController;
    $products = new ProductController();
    $categorys = new CategoryController();
    $commands = new CommandController();
    $status = new StatusController();
    $command = $commands->getCommandByUser($_SESSION['user']);

foreach($command as $cm){
    $product = $products->getProductById($cm['product_id']);
    $imageData = base64_encode($product['image']);
    $imageType = 'image/jpeg';
    $imageDataURL = 'data:' . $imageType . ';base64,' . $imageData;
    $category = $categorys->getCategoryById($product['category_id']);
    $statu = $status->getStatusById($cm['status_id']);
?>
<ul class="list-unstyled">
    <li>
        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="./?page=commandDetails&layout=html&id=<?php echo $cm['id']; ?>">
        <img src="<?php echo $imageDataURL ;?>" style="height: 96px; width: 300px;" class="img-fluid">
        <div class="col-lg-8">
            <h6 class="mb-0"><?php echo $product['name'] ;?></h6>
            <div class="row">
            <small class="text-body-secondary col-4"><?php echo 'commander le '.$cm['date'] ;?></small>
            <small class="text-body-secondary col-4"><?php echo $category;?></small>
            <small class="text-body-secondary col-4"><?php echo $product['price'].' €' ;?></small>
            <p class="text-center rounded  text-<?php echo $statu['name'] == 'Livré'? 'bg-success' : 'bg-warning';?> col-4"><?php echo $statu['name'];?></p>
            </div>
        </div>
        </a>
    </li>
</ul>
<?php
}
?>