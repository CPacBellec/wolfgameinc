<?php
    if(isset($_POST['success'])){
        $command = new \Adam\BoutiqueNws\Controller\CommandController();
        $productQuantity = new \Adam\BoutiqueNws\Controller\ProductController();
        foreach($_SESSION['cart'] as  $product_id){
            $commandStatus = $command->createCommand($_SESSION['user'],$product_id,1);
            if(!$commandStatus){
                echo '<div class="container">
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading text-center">Erreur de transaction</h4>
                            <p class="text-center">veuillez recommencer.</p>
                        </div>  
                    </div>
                </div>';
                break;
            }
            $quantityStatus = $productQuantity->updateProductQuantityWithId($product_id);
            if(!$quantityStatus){
                $statement = $productQuantity->getProductById($product_id);
                echo '<div class="container">
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading text-center">Rupture de stock</h4>
                            <p class="text-center">Rupture de stock pour le produit '.$statement['name'].'.</p>
                        </div>  
                    </div>
                </div>';
                break;
            }
            $cart = $_SESSION['cart'];
            $key = array_search($product_id,$cart);
            unset($cart[$key]);
            $_SESSION['cart'] = $cart;
        }
        if($commandStatus && $quantityStatus){
            unset($_SESSION['cart']);
            header('Location: ./?page=command&layout=html');
            exit;
        }
    }
?>



