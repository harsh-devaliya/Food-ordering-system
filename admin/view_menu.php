<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">View Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu Items / All Menu</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <!-- Where user clicks on delete button, Reload only the table content -->
            <div class="card mb-4" id="fetchMenuItemData">
                <div class="card-body">
                    <div class="clearfix d-flex">
                        <div class="col-6">
                            <form action="" method="GET" class="d-flex">
                                <input type="text" name="search" value="<?php if(isset($_GET['search'])) {echo $_GET['search'];} ?>" placeholder="Search here..." class="form-control">
                                <button type="submit" class="btn btn-primary ms-3">Search</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="add_menu.php" class="btn btn-warning float-end">Add Menu</a>
                        </div>
                    </div>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Populate</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retrieve_data_query = "SELECT * FROM menu ORDER BY menu_id DESC";

                                    if(isset($_GET['search']) && !empty($_GET['search']))
                                    {
                                        $searchdata = $_GET['search'];
                                        $retrieve_data_query = "SELECT * FROM menu WHERE CONCAT(cat_id,name,slug,description,price) LIKE '%$searchdata%' ";
                                    }
                                    $retrieve_data_query_run = mysqli_query($con, $retrieve_data_query);

                                    if(mysqli_num_rows($retrieve_data_query_run) > 0)
                                    {
                                        foreach($retrieve_data_query_run as $data)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $data['menu_id']; ?></td>
                                                <td><?= $data['cat_id']; ?></td>
                                                <td><?= $data['name']; ?></td>
                                                <td><?= $data['description']; ?></td>
                                                <td><?= $data['price']; ?></td>
                                                <td>
                                                    <img src="../uploads/<?= $data['image']; ?>" alt="image" class="rounded" width="100px" height="80px">
                                                </td>
                                                <td>
                                                    <?= $data['popular'] ? '<button class="btn btn-success py-1 px-2">populate</button>' : '<button class="btn btn-danger py-1 px-2">unpopulate</button>'; ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete_menu_btn" value="<?= $data['menu_id']; ?>"><i class="fas fa-trash-can"></i></button>
                                                    <a href="edit_menu.php?menu_id=<?= $data['menu_id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No record found.</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


<?php
include('includes/footer.php');
include('auth_user.php');
?>