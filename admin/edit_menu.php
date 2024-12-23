<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Menu</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu Items / Edit Menu</li>
    </ol>
    <div class="row">
        <div class="col-12">

        <?php
            if(isset($_GET['menu_id']))
            {
                // Now, database table menu_id is stored in $menu_id variable
                $menu_id = $_GET['menu_id'];
                $select_query = "SELECT * FROM menu WHERE menu_id='$menu_id' ";
                $select_query_run = mysqli_query($con, $select_query);

                if(mysqli_num_rows($select_query_run) > 0)
                {
                    $data = mysqli_fetch_array($select_query_run);

                    ?>
                    
                    <div class="card rounded-0 mb-3">
                <div class="card-body">
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <!-- Get Menu ID  for updating the Menu Item data -->
                                <input type="hidden" name="menu_id" value="<?= $data['menu_id']; ?>">

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
                                                <option value="<?= $category['cat_id']; ?>" <?= $data['cat_id'] == $category['cat_id'] ? 'selected' : ''; ?>>
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
                                <input type="text" name="name" value="<?= $data['name']; ?>" placeholder="Enter Menu Item Name" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" value="<?= $data['slug']; ?>" placeholder="Enter Menu Item Slug" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Menu Item Description" rows="3"><?= $data['description']; ?></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Menu Item Price</label>
                                <input type="number" name="price" value="<?= $data['price']; ?>" placeholder="Enter Menu Item Price" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <!-- Here, User can upload new menu item image  -->
                                <label class="form-label">Upload Menu Item Image</label>
                                <input type="file" name="image" class="form-control">
                                <!-- Here, User can see old menu item image, which is uploaded at create menu item time -->
                                 <label class="form-label">Current Menu Item Image</label>
                                 <input type="hidden" name="old_menu_image" value="<?= $data['image']; ?>">
                                 <img src="../uploads/<?= $data['image']; ?>" alt="image" width="80px" height="60px" class="rounded my-2">
                            </div>
                            <div class="col-6 mb-3 ms-3 form-check">
                                <input type="checkbox" name="status" <?= $data['status'] ? 'checked': ''; ?> class="form-check-input">
                                <label class="form-label">Menu Status</label>
                            </div>
                            <div class="col-4 mb-3 form-check">
                                <input type="checkbox" name="popular" <?= $data['popular'] ? 'checked': ''; ?> class="form-check-input">
                                <label class="form-label">Menu Item is Popular or Not?</label>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" name="edit_menu_btn" class="btn btn-primary p-0 py-1 px-2">Update Menu Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


                    <?php
                }
                else
                {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5>Menu Item not found</h5>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                ?>
                <div class="card">
                    <div class="card-body">
                        <h5>MenuID not found in URL</h5>
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