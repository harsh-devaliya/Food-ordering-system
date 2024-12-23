<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');

if(isset($_GET['order_no']))
{
    $ord_no = $_GET['order_no'];

    $fetch_orders_data = "SELECT * FROM orders WHERE ordering_no='$ord_no' ";
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

<div class="container-fluid px-4">
    <h1 class="mt-4">View Order</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Orders / View Order</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
        
            <div class="card mb-3">
                <div class="card-header">
                    <div class="card-title cleafix">
                        <h4 class="float-start">User <span class="text-primary">Delievery Details</span></h4>
                        <a href="all_orders.php" class="float-end btn btn-primary rounded-1" style="font-size: 15px;"><i class="fas fa-reply"></i> Back</a>
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
                        <a href="all_orders.php" class="float-end btn btn-primary rounded-1" style="font-size: 15px;"><i class="fas fa-reply"></i> Back</a>
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
                            <form action="code.php" method="POST">
                                <strong>Delivered Order Status : </strong>
                                <input type="hidden" name="ordering_no" value="<?= $details['ordering_no']; ?>">
                                <select name="order_status" class="form-select w-50">
                                    <option value="0" <?= $details['status']==0 ? 'selected' : ""; ?> >In Process</option>
                                    <option value="1" <?= $details['status']==1 ? 'selected' : ""; ?> >Delivered</option>
                                    <option value="2" <?= $details['status']==2 ? 'selected' : ""; ?> >Cancelled</option>
                                </select>
                                <br>
                                
                                <strong>Order Payment Status : </strong>
                                <div class="form-check">
                                    <input type="checkbox" name="payment_status" class="form-check-input">
                                    <label class="form-label">Order Paid or not?</label>
                                </div>
                                <button type="submit" name="updateOrderDetails" class="btn btn-warning rounded-1 mt-2 py-1">Update Details</button>
                            </form>
                            <br>
                        </div>                    
                    </div>
                    <hr>

                    <div class="row d-flex justify-content-center align-items-center mt-4">
                        <!-- <div class="col-md-12"> -->
                            <div class="row">
                                <div class="card-header bg-dark">
                                    <strong class="col-md-3 text-white" style="margin-right: 20%;">Image</strong>
                                    <strong class="col-md-2 text-white" style="margin-right: 10%;">Name</strong>
                                    <strong class="col-md-2 text-white" style="margin-right: 11%;">Price</strong>
                                    <strong class="col-md-3 text-white" style="margin-right: 17%;">Quantity</strong>
                                    <strong class="col-md-2 text-white">Total Price</strong>
                                </div>
                            </div>

                            <?php
                                $fetch_details = "SELECT odr.id AS ord_id, odr.ordering_no, odr.total_price, itms.*, itms.menu_qty AS qty, mn.* FROM orders odr, order_items itms, menu mn WHERE itms.order_id=odr.id AND mn.menu_id=itms.menu_id AND odr.ordering_no='$ord_no' "; 
                                $fetch_details_run = mysqli_query($con, $fetch_details);

                                if(mysqli_num_rows($fetch_details_run) > 0)
                                {
                                    foreach($fetch_details_run as $item)
                                    {
                                        ?>

                                            <div class="row align-items-center">
                                                <div class="col-md-3 my-2">
                                                    <img src="../uploads/<?= $item['image'] ;?>" alt="image" class="rounded" width="80px" height="60px">
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
                                    
                                        <div class="cleafix mt-2 me-3">
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
include('auth_user.php');
?>