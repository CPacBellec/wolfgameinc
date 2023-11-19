<?php
fromInc('profil');
?>
<main class="flex-shrink-0">
    <div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-5 mx-auto">
                <div class="card mb-4">
                    <div class="card-header text-center">Profil </div>
                    <div class="card-body">
                        <fieldset disabled>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label for="surname" class="form-label">Utilisateur :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                                        </div>
                                        <input class="form-control" id="surname" type="text"  value="<?php echo $_SESSION['user_lastname'].' '.$_SESSION['user_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="email">Email :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                        </div>
                                        <input class="form-control" id="email" type="text" value="<?php echo $_SESSION['user_email']; ?>">  
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row gx-3 mb-3">
                                <div class="col-md-12">
                                    <label class="small mb-1" for="address">Adresse :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="bi bi-house"></i></div>
                                        </div>
                                        <input class="form-control" id="address" type="text"  value="<?php echo $_SESSION['user_address']; ?>">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row gx-3 mb-3 mx-auto">
                            <a class="col-6 btn btn-warning " href="./?page=updatepassword&layout=html" role="button">Modifier le mot de passe ?</a>
                            <div class="col-1"></div>
                            <a class="col-5 btn btn-warning " href="./?page=updateaddress&layout=html" role="button">Modifier l'adresse ?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
