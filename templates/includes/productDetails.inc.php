<?php
    use Adam\BoutiqueNws\Controller\ProductController;
    $product = new ProductController();
    $details = $product->getProductById($_GET['product']);
    $category = $product->getCategoryById($details['category_id']);
    $imageData = base64_encode($details['image']);
    $imageType = 'image/jpeg'; 
    $imageDataURL = 'data:' . $imageType . ';base64,' . $imageData;
?>
<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row p-3">
                <div class="preview col-md-6">
                    <img src="<?php echo $imageDataURL;?>" alt="<?php $details['name'] ?>" width="550" height="330">
                </div>
                <div class="details col-md-6 mt-4">
                    <h3 class="product-title"><?php echo $details['name'];?></h3>
                    <div class="date">
                        <span class="review-no"><?php echo $details['date'];?></span>
                    </div>
                    <br>
                    <p class="product-description"><?php echo $details['description'];?></p>
                    <h4 class="price">Prix : <span><?php echo $details['price'];?> €</span></h4>
                    <p class="quantiter"> Quantiter : <strong><?php echo $details['quantity'];?></strong></p>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="sizes">Category:
                                <span class="size" data-toggle="tooltip" title="small"><?php echo $category;?></span>
                            </h5>
                        </div>
                        
                        <?php if($details['online'] == true){ ?>
                        <div class="col-6">
                            <form action="#" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $details['id'];?>">
                                <button class="add-to-cart btn btn-default btn-primary" type="submit" name="submit">Ajouter au panier</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if(isset($_POST['submit'])){
       $_SESSION['cart'][] = $_POST['product_id'];
    }
?>