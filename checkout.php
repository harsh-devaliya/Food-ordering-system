<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
//include('functions/message.php');
if(!isset($_SESSION['auth']))
{
    redirect("error", "Login to continue!");
    header("Location: login.php");
    exit();
}
?>

<div class="bg-dark py-3">
    <div class="container">
        <h4 class="text-white pt-1">Checkout</h4>
    </div>
</div>


<div class="container my-5">
    <div class="card">
        <div class="card-body shadow">
            <form action="placeorder.php" method="POST">
                <div class="row">
                    
                    <div class="col-md-7">
                        <h4>Basic <span class="text-primary"> Details</span></h4>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label mb-1">Name</label>
                                <input type="text" name="username" placeholder="Enter Your Name" class="form-control rounded-1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label mb-1">Email ID</label>
                                <input type="email" name="emailId" placeholder="Enter Your Email" class="form-control rounded-1">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label mb-1">Phone Number</label>
                                <input type="number" name="contact" placeholder="Enter Your Phoneno" class="form-control rounded-1">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label mb-1">Delivery Place Address</label>
                                <textarea name="address" placeholder="Enter Your Address" class="form-control rounded-1"></textarea>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-5">
                        <h4>Order <span class="text-primary">Menu Details</span></h4>
                        <hr class="my-2">
                        <div class="row align-items-center">
                            <div class="card-header mb-2">
                                <strong class="col-md-3">Image</strong>
                                <strong class="col-md-3 ms-5">Name</strong>
                                <strong class="col-md-2 ms-5">Price</strong>
                                <strong class="col-md-2 ms-5">Qty</strong>
                                <strong class="col-md-2 ms-5">Total</strong>
                            </div>
                        </div>

                        <?php
                            // only logged in user can see cart items
                            $user_id = $_SESSION['auth_user']['user_id'];
                            
                            // fetch data from cart and menu tables
                            $fetch_cart_item = "SELECT ct.cart_id AS cid, ct.menu_id, ct.menu_qty, mn.menu_id as mid, mn.name, mn.image, mn.price FROM cart ct, menu mn WHERE ct.menu_id=mn.menu_id AND ct.user_id='$user_id' ORDER BY ct.cart_id DESC";
                            $fetch_cart_item_run = mysqli_query($con, $fetch_cart_item);

                            $grand_total = 0;

                            foreach($fetch_cart_item_run as $item)
                            {
                                ?>
                                
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <img src="uploads/<?= $item['image']; ?>" alt="image" class="rounded" width="80px" height="60px">
                                        </div>
                                        <div class="col-md-3">
                                            <?= $item['name']; ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $item['price']; ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $item['menu_qty']; ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $item['menu_qty'] * $item['price']; ?>
                                        </div>
                                        <hr class="my-2">
                                    </div>
                                
                                <?php
                                    $grand_total += $item['price'] * $item['menu_qty']; 
                            }

                        ?>

                        <div class="clearfix">
                            <h5>Total Price: <span class="float-end">Rs. <?= $grand_total; ?></span></h5>
                        </div>
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" name="placeOrderBtn" class="btn btn-warning py-1 px-2 mt-2 rounded-1 w-100">Cash On Delivery</button>

                    </div>
                
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include('includes/footer.php');

function redirect($icon, $title)
{
    $_SESSION['message'] = [
        'icon' => $icon,
        'title' => $title
    ];
}

if(isset($_SESSION['message']))
{
    $message = $_SESSION['message'];
    echo "<script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
        Toast.fire({
            icon: '{$message['icon']}',
            title: '<h5>{$message['title']}</h5>'
        });
    </script>";
    unset($_SESSION['message']);
}

?>