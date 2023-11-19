<?php
   if(empty($_SESSION['user']) || empty($_SESSION['cart']) ){
        header("Location: ./?page=login&layout=html");
        exit;
   }
?>
<div class="container">
    <div class="row">
        <img src="./image/vegeta.jpg" class="mx-auto" height="500">
        <h1 class="text-center">DONNE LA MOULA !!!</h1>
    </div>
    <div class="row ">
    <div class="col-3 mx-auto ">
        <a type="submit" class="btn btn-danger" href="./?page=accueil&layout=html" >Je ne donne pas la moula !</a>
    </div>
    <div class="col-3 mx-auto">
        <form  method="post" action="./?page=commandAjout&layout=html">
            <button type="submit" class="btn btn-success" name="success">Je donne la moula !</button>
        </form>
    </div>
</div> 
</div>
