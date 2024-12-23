<?php
session_start();
include('includes/header.php');
include('functions/message.php');
if(isset($_SESSION['auth']))
{
    redirect("info", "You are already Logged In USER!");
    header("Location: index.php");
    exit();
}
?>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-10 col-md-6 col-lg-5">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h4 class="card-title mt-1">Registration</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="post">
                            <div class="mb-3">
                                <input type="text" name="username" placeholder="Enter Your Name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="Enter Email Address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="number" name="phoneno" placeholder="Enter Your Phoneno" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" placeholder="Enter Your Password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="password" name="cpassword" placeholder="Enter Confirm Password" class="form-control">
                            </div>
                            <div class="mb-0">
                                <button type="submit" name="register_btn" class="btn btn-primary">Signup your account</button>
                            </div>
                        </form>
                    </div>
                </div>                
                <p class="text-center mt-4 fs-5">Already you have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
?>