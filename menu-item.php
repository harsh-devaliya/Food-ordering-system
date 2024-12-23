<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
include('functions/message.php');
?>

<?php

if(isset($_GET['category']))
{
    $category_slug = $_GET['category'];
    $category_data_query = "SELECT * FROM categories WHERE slug='$category_slug' AND status='0' LIMIT 1";
    $category_data_query_run = mysqli_query($con, $category_data_query);
    $category = mysqli_fetch_array($category_data_query_run);

    if($category)
    {
        $cid = $category['cat_id'];
        ?>

            <div class="container  mt-5">
                <div class="row justify-content-evenly my-4">
                <?php
                    
                    $fetch_item_query = "SELECT * FROM menu WHERE cat_id='$cid' AND status='0'";
                    $fetch_item_query_run = mysqli_query($con, $fetch_item_query);
                    
                    if(mysqli_num_rows($fetch_item_query_run) > 0)
                    {
                        foreach($fetch_item_query_run as $items)
                        {
                            ?>
                                <div class="col-10 col-sm-10 col-md-5 product_data">
                                    <div class="clearfix">
                                        <div class="float-start">
                                            <h5><?= $items['name']; ?></h5>
                                            <p>Rs. <?= $items['price']; ?></p>
                                            <div class="d-flex justify-content-start mb-0">
                                                <div class="input-group" style="width: 110px;">
                                                    <button type="button" class="input-group-text decrement-btn">-</button>
                                                    <input type="text" value="1" class="form-control input-qty text-center" readonly>
                                                    <button type="button" class="input-group-text increment-btn">+</button>
                                                </div>
                                                <button type="button" class="btn btn-primary rounded-2 ms-2 addToCartBtn" value="<?= $items['menu_id']; ?>">Add Cart</button>
                                            </div>
                                        </div>
                                        <div class="float-end">
                                            <img src="./uploads/<?= $items['image']; ?>" alt="images" class="rounded" width="120px" height="100px">
                                        </div>
                                    </div>
                                    <hr class="mb-5">
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

        <?php
    }
    else
    {
        ?>
        <h5>Something Went Wrong!</h5>
        <?php
    }
}
else
{
    ?>
    <h5>Something Went Wrong!</h5>
    <?php
}

?>

<?php
include('includes/footer.php');
?>

<script type="text/javascript">
    $(document).ready(function () {

        // code for increment the quantity of menu-item
        $('.increment-btn').click(function (e) { 
            e.preventDefault();     // do not page refreshing

            var qty = $(this).closest('.product_data').find('.input-qty').val();
            //alert(qty);
            
            var value = parseInt(qty, 6);
            value = isNaN(value) ? 0 : value;
            if(value < 5)
            {
                value++;
                $(this).closest('.product_data').find('.input-qty').val(value);
            }
        });

        // code for decrement the quantity of menu-item
        $('.decrement-btn').click(function (e) { 
            e.preventDefault();     // do not page refreshing

            var qty = $(this).closest('.product_data').find('.input-qty').val();
            //alert(qty);
            
            var value = parseInt(qty, 6);
            value = isNaN(value) ? 0 : value;
            if(value > 1)
            {
                value--;
                $(this).closest('.product_data').find('.input-qty').val(value);
            }
        });

        // code for adds menu-item in cart.php
        $('.addToCartBtn').click(function (e) { 
            e.preventDefault();
            
            var qty = $(this).closest('.product_data').find('.input-qty').val();
            var menuid = $(this).val();
            //alert(menuid);

            $.ajax({
                method: "POST",
                url: "handlecart.php",
                data: {
                    "menu_id": menuid,
                    "menu_qty": qty,
                    "scope": "add"
                },
                success: function (response) {
                    if(response == 201)
                    {
                        Swal.fire({
                            title: "Success!",
                            text: "Menu-Item added to cart!",
                            icon: "success"
                        });
                    }
                    else if(response == "existing")
                    {
                        Swal.fire({
                            title: "Existed!",
                            text: "Menu-Item already added in cart!",
                            icon: "info"
                        });
                    }
                    else if(response == 500)
                    {
                        Swal.fire({
                            title: "Oops!",
                            text: "Something Went Wrong!",
                            icon: "error"
                        });
                    }
                    else if(response == 401)
                    {
                        Swal.fire({
                            title: "Warning!",
                            text: "Please, Login to continue!",
                            icon: "warning"
                        });
                    }
                }
            });

        });


    });
</script>