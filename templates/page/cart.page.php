<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Détails</span>
            </h4>
            <?php fromInc('cart_price')?>
            <form class="card p-2" method="post" action="./?page=payer&layout=html">
                <button type="submit" class="btn btn-primary">Payer</button>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Produit</h4>
          <?php
            fromInc('cart_product');
          ?>
          
        </div>
    </div>
</div>