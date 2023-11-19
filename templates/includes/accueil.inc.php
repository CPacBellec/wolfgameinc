
<?php
    use Adam\BoutiqueNws\Controller\ProductController;
    use Adam\BoutiqueNws\Controller\Database;
    $database = new Database('BoutiqueSC');
    $product = new ProductController();
    if(isset($_POST['submit'])) {
        $products = $database->searchFiltreTri($_POST['search'],['first'=>true]);
    }else{
        $products = $product->getProductByFilters(['first'=>true,'online'=>true]);
    }
    foreach ($products as $key => $value) {
        $imageData = base64_encode($value['image']);
        $imageType = 'image/jpeg'; 
        $imageDataURL = 'data:' . $imageType . ';base64,' . $imageData;
        $category = $product->getCategoryById($value['category_id']);
        echo '<div class=row>';
            echo '<div class="col-9  mx-auto">';
                echo '<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary-emphasis">'.$category.'</strong>
                        <h3 class="mb-0">'.$value['name'].'</h3>
                        <div class="mb-1 text-body-secondary">'.$value['date'].'</div>
                        <div class="text-truncate" style="max-width: 150px;">
                            <p class="card-text mb-auto">'.$value['description'].'</p>
                        </div>
                        <p class="card-text mb-auto"></p>
                        <div class = "row">
                            <div class = "col-6">
                                <div class ="row">
                                    <div class="col-6">
                                        <p class="card-text mb-auto">'.$value['price'].' €</p>
                                    </div>
                                    <div class="col-6">
                                        <p class="card-text mb-auto">'.$value['quantity'].' en stock</p>
                                    </div>
                                </div>
                            </div>
                            <div class ="col-6">
                                <a href="./?page=productDetails&layout=html&product='.$value['id'].'" class="icon-link gap-1 icon-link-hover stretched-link">
                                    lire la suite
                                    <i class="bi bi-chevron-down"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img src="'.$imageDataURL.'" alt="'.$value['name'].'" width="200" height="250">
                    </div>
                </div>
            </div>';
        echo '</div>';
    }

?>
