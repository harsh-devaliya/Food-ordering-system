<?php
session_start();
include('auth_user.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <?php
                    $users_query = "SELECT * FROM users ";
                    $users_query_run = mysqli_query($con, $users_query); 
                    $total_users = mysqli_num_rows($users_query_run);
                ?>
                <div class="card-body"><h5 class="mt-1">Total Users : <?= $total_users; ?></h5></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="all_users.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <?php
                    $category_query = "SELECT * FROM categories ";
                    $category_query_run = mysqli_query($con, $category_query); 
                    $total_categories = mysqli_num_rows($category_query_run);
                ?>
                <div class="card-body"><h5 class="mt-1">Total Categories : <?= $total_categories; ?></h5></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view_category.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <?php
                    $menuitem_query = "SELECT * FROM menu ";
                    $menuitem_query_run = mysqli_query($con, $menuitem_query); 
                    $total_menuitems = mysqli_num_rows($menuitem_query_run);
                ?>
                <div class="card-body"><h5 class="mt-1">Total Menu : <?= $total_menuitems; ?></h5></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="view_menu.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <?php
                    $menuitem_query = "SELECT * FROM orders ";
                    $menuitem_query_run = mysqli_query($con, $menuitem_query); 
                    $total_menuitems = mysqli_num_rows($menuitem_query_run);
                ?>
                <div class="card-body"><h5 class="mt-1">Total Orders : <?= $total_menuitems; ?></h5></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="all_orders.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
?>