<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="bg-dark py-3">
    <div class="container">
        <h4 class="text-white pt-1">Menu Category</h4>
    </div>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Menu <span class="text-primary">Item List</span></h3>
            <div class="underline" style="width: 80px;"></div>
            <hr class="mt-0">
            <div class="row justify-content-center">
                <?php
                    $select_category = "SELECT * FROM categories";
                    $select_category_run = mysqli_query($con, $select_category);

                    if(mysqli_num_rows($select_category_run) > 0)
                    {
                        foreach($select_category_run as $category)
                        {
                            ?>
                            <div class="col-8 col-sm-8 col-md-3">
                                <div class="card my-4">
                                    <img src="./uploads/<?= $category['image']; ?>" alt="image" class="card-img-top">
                                    <div class="card-body">
                                        <h4 class="card-title text-center"><?= $category['name']; ?></h4>
                                        <hr class="my-2">
                                        <a href="menu-item.php?category=<?= $category['slug']; ?>" class="btn btn-primary w-100">View More...</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <h5>No Category Available!</h5>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('functions/message.php');
?>