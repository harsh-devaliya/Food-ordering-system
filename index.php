<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
include('includes/slider.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3>Today's <span class="text-primary">Special Menu</span></h3>
            <div class="underline" style="width: 110px;"></div>
            <hr class="mt-0">
            <div class="row justify-content-center">
                <div class="owl-carousel owl-theme">
                    <?php
                        $populate_products = "SELECT * FROM menu";
                        $populate_products_run = mysqli_query($con, $populate_products);
                        
                        if(mysqli_num_rows($populate_products_run) > 0)
                        {
                            foreach($populate_products_run as $item)
                            {
                                ?>
                                <div class="item">
                                    <div class="card my-4 mb-0">
                                        <img src="./uploads/<?= $item['image']; ?>" alt="image" class="card-img-top">
                                        <div class="card-body">
                                            <h4 class="card-title"><?= $item['name']; ?></h4>
                                            <div class="d-block text-danger card-price">Rs. <?= $item['price']; ?></div>
                                            <hr class="my-2">
                                            <a href="categories.php" class="btn btn-primary rounded-1 w-100 text-decoration-none">Add Cart</a>
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
</div>

<div class="bg-dark">
    <div class="container mt-4 p-5">
        <div class="row-justify-content-center">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./res-img/r17.jpeg" alt="" class="w-100 rounded">
                    </div>
                    <div class="col-md-6">
                        <a href="aboutus.php"><h6 class="btn btn-light rounded-5 mt-4">About Us</h6></a>
                        <hr class="text-white">
                        <p class="card-text text-light" style="font-size: 16px;">
                            The restaurant is a beautiful place for lunch and dinner. The people are always want to eat the food in restaurant.
                            In the restaurant, all food item made from oats, grains, cheese, etc. things are added for making a meal tasty, spicy, crunchy.
                        </p>
                        <p class="card-text text-light" style="font-size: 16px;"> 
                            The people are always want to eat the food in restaurant.
                            In the restaurant, all food item made from oats, grains, cheese, etc. things are added for making a meal tasty, spicy, crunchy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <h3>Explore <span class="text-primary">Trending Food</span></h3>
            <div class="underline" style="width: 100px;"></div>
            <hr class="mt-0">
            <div class="row justify-content-center">
                <?php
                    $populate_products = "SELECT * FROM menu";
                    $populate_products_run = mysqli_query($con, $populate_products);

                    if(mysqli_num_rows($populate_products_run) > 0)
                    {
                        foreach($populate_products_run as $item)
                        {
                            ?>
                            <div class="col-8 col-sm-8 col-md-3">
                                <div class="card my-4">
                                    <img src="./uploads/<?= $item['image']; ?>" alt="image" class="card-img-top">
                                    <div class="card-body">
                                        <h4 class="card-title"><?= $item['name']; ?></h4>
                                        <div class="d-block text-danger card-price">Rs. <?= $item['price']; ?></div>
                                        <hr class="my-2">
                                        <a href="categories.php" class="btn btn-primary rounded-1 w-100 text-decoration-none">Add Cart</a>
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

<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    });
</script>