<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">All Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Menu Items / Orders</li>
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
                            <a href="view_order_history.php" class="btn btn-warning float-end">Order History</a>
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
                                    <th>Price</th>
                                    <th>Delivered at:</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $retrieve_data_query = "SELECT * FROM orders WHERE status='0' ORDER BY id DESC";

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