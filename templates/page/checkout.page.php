<?php
   if(empty($_SESSION['user']) || empty($_SESSION['cart']) ){
        header("Location: ./?page=login&layout=html");
        exit;
   }
?>
<div class="container">
    <h1 class="text-center">Souhaitez-vous payer cette commande ?</h1>
    <div class="row ">
    <div class="col-3 mx-auto ">
        <a type="submit" class="btn btn-danger" href="./?page=accueil&layout=html" >Non</a>
    </div>
    <div class="col-3 mx-auto">
        <form  method="post" action="./?page=commandAjout&layout=html">
            <button type="submit" class="btn btn-success" name="success">Oui</button>
        </form>
    </div>
</div> 
</div>
