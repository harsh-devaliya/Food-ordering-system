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
        <h4 class="text-white pt-1">My Orders</h4>
    </div>
</div>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <?php
                $user_id = $_SESSION['auth_user']['user_id'];
                
                $fetch_orders_data = "SELECT * FROM orders WHERE user_id='$user_id' ORDER BY id DESC ";
                $fetch_orders_data_run = mysqli_query($con, $fetch_orders_data);

                if(mysqli_num_rows($fetch_orders_data_run) > 0)
                {
                    foreach($fetch_orders_data_run as $orderItems)
                    {
                        ?>
                            
                            <div class="card my-3 px-3">
                                <div class="row d-flex">
                                    <div class="col-md-3 mt-2">
                                        <strong>Order No:</strong>
                                        <br><p class="mb-2"><?= $orderItems['ordering_no']; ?></p>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <strong>Total Price:</strong>
                                        <br><p class="mb-2">Rs. <?= $orderItems['total_price']; ?></p>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <strong>Booking Order at:</strong>
                                        <br><p class="mb-2"><?= date("d-m-Y h:i A", strtotime($orderItems['create_at'])) ?></p>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <strong>Order Status:</strong>
                                        <br>
                                        <?php
                                            if($orderItems['status']==0) {
                                                ?><button class="btn btn-warning text-white rounded-1 py-1 mb-2" style="font-size: 14px;">In Process</button><?php
                                            }
                                            else if($orderItems['status']==1) {
                                                ?><button class="btn btn-success text-white rounded-1 py-1 mb-2" style="font-size: 14px;">Delivered</button><?php
                                            }
                                            else if($orderItems['status']==2) {
                                                ?><button class="btn btn-danger text-white rounded-1 py-1 mb-2" style="font-size: 14px;">Cancelled</button><?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <strong>Order Details:</strong>
                                        <br>
                                        <a href="view-order.php?order_no=<?= $orderItems['ordering_no']; ?>" class="btn btn-primary rounded-1 py-1" style="font-size: 14px;">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php
                    }
                }
                else
                {
                    ?>

                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center mt-2">You have not any order!</h4>
                                </div>
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