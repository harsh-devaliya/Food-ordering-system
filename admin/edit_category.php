<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Categories / Edit Category</li>
    </ol>
    <div class="row">
        <div class="col-12">

            <?php
            if (isset($_GET['cat_id'])) {
                // Now, database table cat_id store in $category_id variable.
                $category_id = $_GET['cat_id'];
                $select_query = "SELECT * FROM categories WHERE cat_id='$category_id' ";
                $select_query_run = mysqli_query($con, $select_query);

                if (mysqli_num_rows($select_query_run) > 0) {
                    $data = mysqli_fetch_array($select_query_run);

            ?>

                    <div class="card rounded-0 mb-3">
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <!-- Get Category ID for updating the Category data -->
                                        <input type="hidden" name="category_id" value="<?= $data['cat_id']; ?>">
                                        
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" value="<?= $data['name']; ?>" placeholder="Enter Category Name" class="form-control">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" name="slug" value="<?= $data['slug']; ?>" placeholder="Enter Category Slug" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" placeholder="Enter Category Description" rows="3"><?= $data['description']; ?></textarea>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <!-- Here, user can upload new categroy image  -->
                                        <label class="form-label">Upload Category Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <!-- Here, user can see old category image, which uploaded at create category time.  -->
                                        <label class="form-label">Current Category Image</label>
                                        <input type="hidden" name="old_cat_image" value="<?= $data['image']; ?>">
                                        <img src="../uploads/<?= $data['image']; ?>" alt="image" width="80px" height="60px" class="rounded my-2">
                                    </div>
                                    <div class="col-6 mb-3 ms-3 form-check">
                                        <input type="checkbox" name="status" <?= $data['status'] ? 'checked':''; ?> class="form-check-input">
                                        <label class="form-label">Category Status</label>
                                    </div>
                                    <div class="col-4 mb-3 form-check">
                                        <input type="checkbox" name="popular" <?= $data['popular'] ? 'checked':''; ?> class="form-check-input">
                                        <label class="form-label">Category Popular or Not.</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" name="edit_category_btn" class="btn btn-primary p-0 py-1 px-2">Update Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h5>Category not found</h5>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5>CategoryID not found in URL</h5>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>


<?php
include('includes/footer.php');
include('auth_user.php');
?>