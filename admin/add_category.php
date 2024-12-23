<?php
session_start();
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Add Category</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Categories / Add Category</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card rounded-0 mb-3">
                <div class="card-body">
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" placeholder="Enter Category Slug" class="form-control">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" placeholder="Enter Category Description" rows="3"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Upload Category Image</label>
                                <input type="file" name="image" placeholder="Enter Category Image" class="form-control">
                            </div>
                            <div class="col-6 mb-3 ms-3 form-check">
                                <input type="checkbox" name="status" class="form-check-input">
                                <label class="form-label">Category Status</label>
                            </div>
                            <div class="col-4 mb-3 form-check">
                                <input type="checkbox" name="popular" class="form-check-input">
                                <label class="form-label">Category is Popular or Not?</label>
                            </div>
                            <div class="col-12 mb-3">
                                <button type="submit" name="add_category_btn" class="btn btn-primary p-0 py-1 px-2">Add Category</button>
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