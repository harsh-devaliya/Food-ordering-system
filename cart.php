<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
include('functions/message.php');
if(!isset($_SESSION['auth']))
{
    redirect("error", "Login to continue!");
    header("Location: login.php");
    exit();
}
?>

<div class="bg-dark py-3">
    <div class="container">
        <h4 class="text-white pt-1">My Cart</h4>
    </div>
</div>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12 myCart">
            <div class="card rounded-1">
                <div class="card-header">
                    <div class="row">
                        <strong class="col-md-3 ">Image</strong>
                        <strong class="col-md-2">Name</strong>
                        <strong class="col-md-2">Price</strong>
                        <strong class="col-md-3">Quantity</strong>
                        <strong class="col-md-2">Action</strong>
                    </div>
                </div>

                    <?php
                        // only logged in user can see cart items
                        $user_id = $_SESSION['auth_user']['user_id'];
                        
                        // fetch data from cart and menu tables
                        $fetch_cart_item = "SELECT ct.cart_id AS cid, ct.menu_id, ct.menu_qty, mn.menu_id as mid, mn.name, mn.image, mn.price FROM cart ct, menu mn WHERE ct.menu_id=mn.menu_id AND ct.user_id='$user_id' ORDER BY ct.cart_id DESC";
                        $fetch_cart_item_run = mysqli_query($con, $fetch_cart_item);

                        $total_price = 0;

                        if(mysqli_num_rows($fetch_cart_item_run) > 0)
                        {
                            foreach($fetch_cart_item_run as $cart_item)
                            {
                                ?>
                                
                                <div class="row">
                                    <!-- only this part refreshing, if any changes occurs -->
                                    <div class="card-body d-flex align-items-center product_data">
                                        
                                        <div class="col-md-3">
                                            <img src="uploads/<?= $cart_item['image']; ?>" class="ms-2 rounded" alt="image" width="100px" height="80px">
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <?= $cart_item['name']; ?>
                                        </div>
                                        
                                        <div class="col-md-2 ms-2">
                                            Rs. <?= $cart_item['price']; ?>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <!-- Here, when user changes the qty of item, it will change by menu_id -->
                                            <input type="hidden" class="menuId" value="<?= $cart_item['menu_id']; ?>">
                                            <div class="input-group" style="width: 110px;">
                                                <button type="button" class="input-group-text rounded-0 decrement-btn updateMenuQty">-</button>
                                                <input type="text" class="form-control input-qty text-center" value="<?= $cart_item['menu_qty']; ?>" readonly>
                                                <button type="button" class="input-group-text rounded-0 increment-btn updateMenuQty">+</button>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <button style="margin-left: -20px;" class="btn btn-danger rounded-1 deleteMenuItem" value="<?= $cart_item['cid']; ?>" type="button">
                                                <i class="fas fa-trash-can"></i> Remove
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <hr class="my-0">

                                

                                <?php
                                    $total_price += $cart_item['price'] * $cart_item['menu_qty'];
                            }
                            ?>
                            
                            <div class="clearfix mt-3 me-3">
                                <h5 class="float-end mb-0">Total Price: <?= $total_price; ?></h5>
                            </div>
                            <div class="d-flex justify-content-end mt-2 mb-3 me-3">
                                <a href="checkout.php" class="btn btn-outline-primary rounded-1">
                                    <i class="fas fa-shopping-cart"></i> Checkout
                                </a>
                            </div>

                            <?php
                        }
                        else
                        {
                            ?>
                            
                            <div class="row">
                                <div class="card-body">
                                    <h3 class="text-center my-3">Your cart is empty!</h3>
                                </div>
                            </div>

                            <?php
                        }
                    ?>

            </div>

        </div>
    </div>
</div>


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

        // code for update the Quantity of Menu Item in card.php
        $(document).on('click','.updateMenuQty', function () {
            
            //alert("OK");

            var qty = $(this).closest('.product_data').find('.input-qty').val();   
            var menu_id = $(this).closest('.product_data').find('.menuId').val();   
            //alert(qty);

            $.ajax({
                method: "POST",
                url: "handlecart.php",
                data: {
                    "menu_id": menu_id,
                    "menu_qty": qty,
                    "scope": "update"
                },
                success: function (response) {
                    alert(response);
                }
            });

        });       


        // code for delete the menu item from cart.php
        $(document).on('click','.deleteMenuItem', function () {
            
            var cart_id = $(this).val();
            //alert(cart_id);

            $.ajax({
                method: "POST",
                url: "handlecart.php",
                data: {
                    "cart_id": cart_id,
                    "scope": "delete"
                },
                success: function (response) {
                    if(response == 200)
                    {
                        Swal.fire({
                            title: "Success!",
                            text: "MenuItem deleted Successfully!",
                            icon: "success"
                        });        
                        $('.myCart').load(location.href + " .myCart");
                    }
                    else
                    {
                        alert(response);
                    }
                }
            });

        });

    });
</script>