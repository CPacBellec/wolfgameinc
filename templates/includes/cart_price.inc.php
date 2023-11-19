<?php
use Adam\BoutiqueNws\Controller\ProductController;
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }else{
        $cart = [];
    }
    $prices = new ProductController();
?>
    
<?php
$total = 0;
foreach($cart as $productId){
    $price = $prices->getProductById($productId);
    $total += $price['price'];
?>
<ul class="list-group mb-3">
    <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
            <h6 class="my-0"><?php echo $price['name'] ; ?></h6>
        </div>
        <span class="text-muted"><?php echo $price['price'].' €'; ?></span>
    </li>
<?php
}
?>
    <li class="list-group-item d-flex justify-content-between">
        <span>Total (EUR)</span>
        <strong><?php echo $total.' €'; ?></strong>
    </li>
</ul>