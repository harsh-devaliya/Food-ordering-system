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

if(isset($_GET['order_no']))
{
    $ord_no = $_GET['order_no'];
    $user_id = $_SESSION['auth_user']['user_id'];

    $fetch_orders_data = "SELECT * FROM orders WHERE ordering_no='$ord_no' AND user_id='$user_id' ";
    $fetch_orders_data_run = mysqli_query($con, $fetch_orders_data);

    if(mysqli_num_rows($fetch_orders_data_run) < 0)
    {
        ?>
            <strong>orderno is missing from url!</strong>
        <?php
        die();
    }
}
else
{
    ?>
        <strong>orderno is missing from the url!</strong>
    <?php
    die();
}
$details = mysqli_fetch_array($fetch_orders_data_run);

?>

<div class="bg-dark py-3">
    <div class="container">
        <h4 class="text-white pt-1">View Order</h4>
    </div>
</div>


<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
        
            <div class="card mb-3">
                <div class="card-header">
                    <div class="card-title cleafix">
                        <h4 class="float-start">User <span class="text-primary">Delievery Details</span></h4>
                        <a href="my-orders.php" class="float-end btn btn-primary rounded-1" style="font-size: 15px;"><i class="fas fa-reply"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-md-4 mb-3">
                            <p class="mb-1">Username</p>
                            <input type="text" class="form-control rounded-1" value="<?= $details['username']; ?>" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="mb-1">Email Address</p>
                            <input type="text" class="form-control rounded-1" value="<?= $details['email']; ?>" readonly>
                        </div>
                        <div class="col-md-4 mb-3">
                            <p class="mb-1">Phone Number</p>
                            <input type="text" class="form-control rounded-1" value="<?= $details['phone']; ?>" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="mb-1">Username</p>
                            <textarea class="form-control"><?= $details['address']; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-3">
                <div class="card-header">
                    <div class="card-title cleafix">
                        <h4 class="float-start">My Order<span class="text-primary"> Details</span></h4>
                        <a href="my-orders.php" class="float-end btn btn-primary rounded-1" style="font-size: 15px;"><i class="fas fa-reply"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row d-flex">
                        <div class="col-md-6">
                            <strong>Order Bill No : </strong><?= $details['ordering_no']; ?><br>        
                            <strong>Payment Mode : </strong><?= $details['payment_mode']; ?><br>    
                            <strong>Booking Order at : </strong><?= date("d-m-Y h:i A", strtotime($details['create_at'])) ?><br>    
                        </div>
                        <div class="col-md-6">
                            <strong>Delivered Order Status : </strong>
                            <?php
                                if($details['status']==0) {
                                    ?><button class="btn btn-warning text-white rounded-1 py-0 px-1" style="font-size: 14px;">In Process</button><?php
                                }
                                else if($details['status']==1) {
                                    ?><button class="btn btn-success text-white rounded-1 py-0 px-1" style="font-size: 14px;">Delivered</button><?php
                                }
                                else if($details['status']==2) {
                                    ?><button class="btn btn-danger text-white rounded-1 py-0 px-1" style="font-size: 14px;">Cancelled</button><?php
                                }
                            ?>
                            <br>
                            
                            <strong>Order Payment Status : </strong>
                            <?php
                                if($details['payment_id']==1) {
                                    echo "Paid";
                                }
                                else if($details['payment_id']==0) {
                                    echo "Pending";
                                }
                            ?>
                            <br>

                            <form action="code.php" method="POST">
                                <?php
                                    if($details['status']!=1 && $details['status']!=2) {
                                        ?><button name="cancelOrderBtn" class="btn btn-danger text-white rounded-1 mt-2 py-1" style="font-size: 14px;"><i class="fas fa-close"></i> Cancel Order</button><?php
                                    }
                                ?>
                             </form>
                        </div>                    
                    </div>
                    <hr>

                    <div class="row d-flex justify-content-center align-items-center mt-4">
                        <!-- <div class="col-md-12"> -->
                            <div class="row">
                                <div class="card-header bg-dark">
                                    <strong class="col-md-3 text-white" style="margin-right: 22%;">Image</strong>
                                    <strong class="col-md-2 text-white" style="margin-right: 9%;">Name</strong>
                                    <strong class="col-md-2 text-white" style="margin-right: 12%;">Price</strong>
                                    <strong class="col-md-3 text-white" style="margin-right: 18%;">Quantity</strong>
                                    <strong class="col-md-2 text-white">Total Price</strong>
                                </div>
                            </div>

                            <?php
                                $fetch_details = "SELECT odr.id AS ord_id, odr.ordering_no, odr.user_id, odr.total_price, itms.*, itms.menu_qty AS qty, mn.* FROM orders odr, order_items itms, menu mn WHERE odr.user_id='$user_id' AND itms.order_id=odr.id AND mn.menu_id=itms.menu_id AND odr.ordering_no='$ord_no' "; 
                                $fetch_details_run = mysqli_query($con, $fetch_details);

                                if(mysqli_num_rows($fetch_details_run) > 0)
                                {
                                    foreach($fetch_details_run as $item)
                                    {
                                        ?>

                                            <div class="row align-items-center">
                                                <div class="col-md-3 my-2">
                                                    <img src="uploads/<?= $item['image'] ;?>" alt="image" class="rounded" width="90px" height="70px">
                                                </div>
                                                <div class="col-md-2 my-2">
                                                    <?= $item['name']; ?>
                                                </div>
                                                <div class="col-md-2 my-2">
                                                    <?= $item['price']; ?>
                                                </div>
                                                <div class="col-md-3 my-2">
                                                    <?= $item['qty']; ?>
                                                </div>
                                                <div class="col-md-2 my-2">
                                                    <?= $item['price'] * $item['qty']; ?>
                                                </div>
                                                <hr class="m-0">
                                            </div>

                                        <?php
                                    }
                                    ?>
                                    
                                        <div class="cleafix mt-2 me-4">
                                            <h5 class="float-end">Grand Total: <?= $item['total_price']; ?></h5>
                                        </div>

                                    <?php
                                }
                            ?>

                        <!-- </div> -->
                    </div>

                </div>
            </div>
        
        
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