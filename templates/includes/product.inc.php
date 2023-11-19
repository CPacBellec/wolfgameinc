<?php
    use Adam\BoutiqueNws\Controller\ProductController;
    $product = new ProductController();
    $products = $product->getAllProducts();
    foreach ($products as $key => $value) {
        $imageData = base64_encode($value['image']);
        $imageType = 'image/jpeg'; 
        $imageDataURL = 'data:' . $imageType . ';base64,' . $imageData;
        $category = $product->getCategoryById($value['category_id']);
        echo '<div class=row>';
            echo '<div class="col-9  ms-auto me-4 mt-3">';
                if(isset($_GET['adminMod']) && $_GET['adminMod'] === "product"){
                   echo '<a href="./?page=adminMod&layout=html&adminMod=productUpdate&id='.$value['id'].'" > <i class="bi bi-pencil-square"></i></a>';
                   echo '<a href="./?page=adminMod&layout=html&adminMod=productDelete&id='.$value['id'].'" > <i class="bi bi-trash"></i></a>';
                }
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

<!--<div class="row">
    <div class="col-9  ms-auto me-4 mt-3">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>
                <h3 class="mb-0">Featured post</h3>
                <div class="mb-1 text-body-secondary">Nov 12</div>
                <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                Continue reading
                <svg class="bi"><use xlink:href="#chevron-right"></use></svg>
                </a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
            </div>
        </div>
    </div>
</div>-->