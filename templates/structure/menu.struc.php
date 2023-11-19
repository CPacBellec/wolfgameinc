<?php
use Adam\BoutiqueNws\Controller\CategoryController;

$CategoryController = new CategoryController();
$category = $CategoryController->getAllCategory();
?>
<header class="p-2 <?php echo isset($_GET['page']) && $_GET['page'] !=='adminMod'? "mb-3" : "mb-0"; ?> border-bottom bg-dark" <?php echo isset($_GET['page']) && $_GET['page'] ==='adminMod'?  'style=" position: fixed; width:100% ;  z-index: 1000;"':'';?> >
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="./?page=accueil&layout=html" class="d-flex align-items-center m-1  link-light text-decoration-none">
                <span class="navbar-brand ">SC SHOP</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li>
                    <a href="./?page=accueil&layout=html" class="nav-link px-2 link-<?php echo isset($_GET['page']) && $_GET['page']==='accueil'? 'primary' :'light'; ?>">Accueil</a>
                </li>
                <li>
                    <div class="dropdown p-2" id="dropdownCategory" >
                        <a href="#" class="d-bloc text-decoration-none dropdown-toggle text-<?php echo isset($_GET['page']) && $_GET['page']==='category'? 'primary' :'light'; ?> ">
                            Category
                        </a>
                        <ul class="dropdown-menu text-small" >
                            <li><a class="dropdown-item" href="./?page=category&layout=html&category=all">Toute</a></li>
                            <?php foreach ($category as $key => $value) {
                                echo '<li><a class="dropdown-item" href="./?page=category&layout=html&category='.$value['id'].'">'.$value['name'].'</a></li>';
                            }?>
                        </ul>
                    </div>
                </li>
            </ul>
            <?php if(isset($_GET['page']) && $_GET['page']==='accueil' ||  $_GET['page']==='category' ): ?>   
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" action="#" method="post" >
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Chercher..." name="search" value="<?php echo isset($_POST['search'])? $_POST['search'] : ""; ?>">
                    <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
                </div>
            </form>
            <?php endif; ?>

            <a href="./?page=cart&layout=html" class="  text-decoration-none  text-<?php echo isset($_GET['page']) && $_GET['page']==='cart'? 'primary' :'light'; ?> px-2">
                <i class="bi bi-cart2"></i>
            </a>
           
            <?php if(isset($_SESSION['user'])): ?>
                <div class="dropdown" id="dropdownProfils" >
                    <a href="#" class="d-block  text-decoration-none dropdown-toggle text-<?php echo isset($_GET['page']) && $_GET['page']==='profil' ||$_GET['page']==='updateaddress' || $_GET['page']==='updatepassword' || $_GET['page'] === 'adminMod' ? 'primary' :'light'; ?> ">
                        <i class="bi bi-person-circle "></i>
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li class="text-center"><?php echo $_SESSION['user_lastname'].' '.$_SESSION['user_name'] ?></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 999 ){ ?>
                        <li><a class="dropdown-item" href="./?page=adminMod&layout=html&adminMod=product">Mode administrateur</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="./?page=command&layout=html">Mes commandes</a></li>
                        <li><a class="dropdown-item" href="./?page=profil&layout=html">Profile</a></li>
                        <li><a class="dropdown-item" href="./?page=updateaddress&layout=html">Adresse</a></li>
                        <li><a class="dropdown-item" href="./?page=updatepassword&layout=html">Mot de passe</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="./?page=signout&layout=html">Déconnexion</a></li>
                    </ul>
                </div>
            <?php endif; ?>
            
            <?php if(empty($_SESSION['user'])): ?>
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="./?page=login&layout=html" class="nav-link link-light <?php echo (isset( $_GET['page']) ? ($_GET['page'] == "login" ? "active" : "") : "active"); ?>" aria-current="page">Connexion</a></li>
                    <li class="nav-item"><a href="./?page=signup&layout=html" class="nav-link link-light <?php echo (isset( $_GET['page']) && $_GET['page'] == "signup") ? "active" : ""; ?>">Inscription</a></li>
                </ul>
            <?php endif; ?>
        
        
        
        </div>
    </div>
</header>
  