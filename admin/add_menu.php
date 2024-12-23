<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Add Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu Items / Add Menu</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card rounded-0 mb-3">
                <div class="card-body">
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Select Category</label>
                                <select name="category_id" class="form-select">
                                    <option selected disabled> -- Select the category -- </option>
                                    <?php
                                        $select_category = "SELECT * FROM categories";
                                        $select_category_run = mysqli_query($con, $select_category);

                                        if(mysqli_num_rows($select_category_run) > 0)
                                        {
                                            foreach($select_category_run as $category)
                                            {
                                                ?>
                                                <option value="<?= $category['cat_id']; ?>">
                                                    <?= $category['name']; ?>
                                                </option>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "Category is not available!";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" placeholder="Enter Menu Item Name" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" placeholder="Enter Menu Item Slug" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Menu Item Description" rows="3"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Menu Item Price</label>
                                <input type="number" name="price" placeholder="Enter Menu Item Price" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Upload Menu Item Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-6 mb-3 ms-3 form-check">
                                <input type="checkbox" name="status" class="form-check-input">
                                <label class="form-label">Menu Status</label>
                            </div>
                            <div class="col-4 mb-3 form-check">
                                <input type="checkbox" name="popular" class="form-check-input">
                                <label class="form-label">Menu Item is Popular or Not?</label>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" name="add_menu_btn" class="btn btn-primary p-0 py-1 px-2">Add Menu Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');
include('auth_user.php');
?>