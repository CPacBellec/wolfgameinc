<?php
use Adam\BoutiqueNws\Controller\ProductController;
use Adam\BoutiqueNws\Controller\CategoryController;
    if(isset($_POST['close'])){
        $cart = $_SESSION['cart'];
        $key = array_search($_POST['close'],$cart);
        unset($cart[$key]);
        $_SESSION['cart'] = $cart;
    }
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }else{
        $cart = [];
    }
    $products = new ProductController();
    $categorys = new CategoryController();
?>
    
<?php
foreach($cart as $productId){
    $product = $products->getProductById($productId);
    $imageData = base64_encode($product['image']);
    $imageType = 'image/jpeg'; 
    $imageDataURL = 'data:' . $imageType . ';base64,' . $imageData;
    $category = $categorys->getCategoryById($product['category_id']);
?>
<ul class="list-unstyled">
    <li>
        <form action="#" method="post">
            <button type="submit" class="btn-close" value="<?php echo $product['id']; ?>" name="close"></button>
        </form>
        <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="./?page=productDetails&layout=html&product=<?php echo $product['id']; ?>">
        <img src="<?php echo $imageDataURL ;?>" style="height: 96px;" class="img-fluid">
        <div class="col-lg-8">
            <h6 class="mb-0"><?php echo $product['name'] ;?></h6>
            <div class="row">
            <small class="text-body-secondary col-4"><?php echo $product['date'] ;?></small>
            <small class="text-body-secondary col-4"><?php echo $category;?></small>
            <small class="text-body-secondary col-4"><?php echo $product['price'].' €' ;?></small>
            </div>
        </div>
        </a>
    </li>
</ul>
<?php
}
?>