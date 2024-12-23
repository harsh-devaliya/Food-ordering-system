<?php
session_start();
include('config/dbconnect.php');
include('includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">All Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Registered Users / All Users</li>
    </ol>
    <div class="row">
        <div class="col-12">
            <!-- Where user clicks on delete button, Reload only the table content -->
            <div class="card mb-4" id="fetchUserRecords">
                <div class="card-body">
                    <div class="col-6">
                        <form action="" method="GET" class="d-flex">
                            <input type="text" name="search" value="<?php if(isset($_GET['search'])) { echo $_GET['search']; } ?>" placeholder="Search here..." class="form-control">
                            <button type="submit" class="btn btn-primary ms-3">Search</button>
                        </form>
                    </div>

                    <hr>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usename</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Create_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql_query = "SELECT * FROM users";

                                    if(isset($_GET['search']) && !empty($_GET['search']))
                                    {
                                        $searchdata = $_GET['search'];
                                        $sql_query = "SELECT * FROM users WHERE CONCAT(username,email,phoneno) LIKE '%$searchdata%' ";
                                    }
                                    $sql_query_run = mysqli_query($con, $sql_query);
                                    
                                    if(mysqli_num_rows($sql_query_run) > 0)
                                    {
                                        //while($data = mysqli_fetch_assoc($sql_query_run))
                                        foreach($sql_query_run as $data)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $data['id']; ?></td>
                                                <td><?= $data['username']; ?></td>
                                                <td><?= $data['email']; ?></td>
                                                <td><?= $data['phoneno']; ?></td>
                                                <td><?= $data['create_at']; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger delete_user_btn" value="<?= $data['id']; ?>"><i class="fas fa-trash-can"></i> Delete</button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No record found.</td>
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