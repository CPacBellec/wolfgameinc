<?php
    use Adam\BoutiqueNws\Controller\CommandController;
    use Adam\BoutiqueNws\Controller\ProductController;
    use Adam\BoutiqueNws\Controller\UserController;

    $commandController = new CommandController();
    $productController = new ProductController();
    $userController = new UserController();
    
    $details = $commandController->getCommandById($_GET['id']);
    $status = $commandController->getStatusById($details['status_id']);
    $product = $productController->getProductById($details['product_id']);
    $category = $productController->getCategoryById($product['category_id']);
    $user = $userController->getUserById($details['user_id']);
    $imageData = base64_encode($product['image']);
    $imageType = 'image/jpeg'; 
    $imageDataURL = 'data:' . $imageType . ';base64,' . $imageData;
?>
<div class="container">
    <h2 style="text-align: center;">Information de la commande</h2>
    <div class="card"> 
        <div class="container-fliud">
            <div class="wrapper row p-3">
                <h3>Information du produit :</h3>
                <div class="preview col-md-6">
                    <img src="<?php echo $imageDataURL;?>" alt="<?php echo $product['name']; ?>" width="550" height="330">
                </div>
                <div class="details col-md-6 mt-4">
                    <h3 class="product-title"><?php echo $product['name'].' (id: '.$details['id'].')';?></h3>
                    <div class="date">
                        <span class="review-no"><?php echo $product['date'];?></span>
                    </div>
                    <br>
                    <p class="product-description"><?php echo $product['description'];?></p>
                    <h4 class="price">Prix : <span><?php echo $product['price'];?> €</span></h4>
                    <p class="quantiter"> Quantiter : <strong><?php echo $product['quantity'];?></strong></p>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="sizes">Category:
                                <span class="size" data-toggle="tooltip" title="small"><?php echo $category;?></span>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card"> 
        <div class="container-fliud">
            <div class="wrapper row p-3">
                <div class="col-md-6">
                    <h3>Information de l'utilisateur :</h3>
                    <br>
                    <p class="product-description">Utilisateur : <?php echo $user['lastname'].' '.$user['name'];?></p>
                    <p class="price">Email : <span><?php echo $user['email'];?> </span></p>
                    <p class="quantiter"> Adresse : <strong><?php echo $user['address'];?></strong></p>
                </div>
                <div class="col-md-6 ">
                    <h3>Information de la commande :</h3>
                    <br>
                    <p class="product-description">Id de la commande : <?php echo $details['id'];?></p>
                    <p class="price"><span>Date de la commande : <?php echo $details['date'];?></span></p>
                    <p class="quantiter"> Status de la commande : <strong><?php echo $status['name'];?></strong></p>
                </div>
            </div>
        </div>
    </div>
</div>