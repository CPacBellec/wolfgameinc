<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px; position: fixed; height: 100%;top: 55px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Mode administrateur</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="./?page=adminMod&layout=html&adminMod=product" class="nav-link <?php echo isset($_GET['adminMod']) && $_GET['adminMod'] === "product"? "active" : "text-white" ;?>">
                <i class="bi bi-box-seam p-2"></i>
                Produits
            </a>
        </li>
        <li>
            <a href="./?page=adminMod&layout=html&adminMod=category" class="nav-link <?php echo isset($_GET['adminMod']) && $_GET['adminMod'] === "category"? "active" : "text-white" ;?>">
            <i class="bi bi-tag p-2"></i>
                Category
            </a>
        </li>
        <li class="nav-item">
            <a href="./?page=adminMod&layout=html&adminMod=commands" class="nav-link <?php echo isset($_GET['adminMod']) && $_GET['adminMod'] === "commands"? "active" : "text-white" ;?>">
                <i class="bi bi-mailbox-flag p-2"></i>
                Commandes
            </a>
        </li>
        <li>
            <a href="./?page=adminMod&layout=html&adminMod=inventory" class="nav-link <?php echo isset($_GET['adminMod']) && $_GET['adminMod'] === "inventory"? "active" : "text-white" ;?>">
                <i class="bi bi-ui-checks-grid p-2"></i>
                Inventaires
            </a>
        </li>
    </ul>
    <hr>
</div>
