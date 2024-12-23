<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">View Order History</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Orders / View Order History</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="clearfix d-flex">
                        <div class="col-6">
                            <form action="" method="GET" class="d-flex">
                                <input type="text" name="search" value="<?php if(isset($_GET['search'])) {echo $_GET['search'];} ?>" placeholder="Search here..." class="form-control">
                                <button type="submit" class="btn btn-primary ms-3">Search</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <a href="all_orders.php" class="btn btn-warning float-end"><i class="fas fa-reply"></i> Back</a>
                        </div>
                    </div>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order No</th>
                                    <th>Username</th>
                                    <th>Total Price</th>
                                    <th>Pay. Status</th>
                                    <th>Order Status</th>
                                    <th>Delivered at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retrieve_data_query = "SELECT * FROM orders WHERE status!='0' ORDER BY id DESC";

                                    if(isset($_GET['search']) && !empty($_GET['search']))
                                    {
                                        $searchdata = $_GET['search'];
                                        $retrieve_data_query = "SELECT * FROM orders WHERE CONCAT(ordering_no, username, total_price, create_at) LIKE '%$searchdata%' ";
                                    }
                                    $retrieve_data_query_run = mysqli_query($con, $retrieve_data_query);

                                    if(mysqli_num_rows($retrieve_data_query_run) > 0)
                                    {
                                        foreach($retrieve_data_query_run as $data)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= $data['ordering_no']; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td><?= $data['total_price']; ?></td>
                                                <td>
                                                    <?php
                                                        if($data['payment_id']==1) {
                                                            echo "Paid";
                                                        } 
                                                        elseif($data['payment_id']==0) {
                                                            echo "Pending";
                                                        } 
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($data['status']==1) {
                                                            ?>
                                                            <button class="btn btn-success text-white fw-bold rounded-1 py-1" style="font-size: 14px;">Delivered</button>
                                                            <?php
                                                        }
                                                        elseif($data['status']==2) {
                                                            ?>
                                                            <button class="btn btn-danger text-white fw-bold rounded-1 py-1" style="font-size: 14px;">Cancelled</button>
                                                            <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td><?= date("d-m-Y h:i A", strtotime($data['create_at'])); ?></td>
                                                <td>
                                                <a href="view-order.php?order_no=<?= $data['ordering_no']; ?>" class="btn btn-info text-white fw-bold rounded-1 py-1">View Order</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No record found.</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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