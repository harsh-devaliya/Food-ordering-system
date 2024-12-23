<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Admin Dashboard Link -->
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <!-- Display All registered users -->
                <a class="nav-link" href="all_users.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Registerd Users
                </a>
                <!-- Add/View Categories -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Categories
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="view_category.php">All Category</a>
                        <a class="nav-link" href="add_category.php">Add Category</a>
                    </nav>
                </div>
                <!-- Add/View Menu Items -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-plate-wheat"></i></div>
                    Menu Items
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="view_menu.php">All Menu</a>
                        <a class="nav-link" href="add_menu.php">Add Menu</a>
                    </nav>
                </div>
                <!-- Display All orders of user -->
                <a class="nav-link" href="all_orders.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-bag"></i></div>
                    Orders
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['auth_user']['username']; ?>
        </div>
    </nav>
</div>