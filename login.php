<?php
session_start();
include('includes/header.php');
?>

    <!-- API link -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function enableSubmitbtn() {
            document.getElementById('mySubmitBtn').disabled = false;
        }
    </script>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-10 col-md-6 col-lg-5">
                <div class="card rounded-0">
                    <div class="card-header">
                        <h4 class="card-title mt-1">Login Now</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="post">
                            <div class="mb-3">
                                <label class="form-label mb-1">Email Address</label>
                                <input type="email" name="email" placeholder="Enter Email Address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1">Password</label>
                                <input type="password" name="password" placeholder="Enter Your Password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <div class="g-recaptcha" data-sitekey="6LdoM08qAAAAADQSWt7m8Fb778b17g01G7e8U4VB" data-callback="enableSubmitbtn"></div>
                            </div>
                            <div class="mb-0">
                                <button type="submit" id="mySubmitBtn" name="login_btn" disabled="disabled" class="btn btn-primary">Login your account</button>
                            </div>
                        </form>
                    </div>
                </div> 
                <p class="text-center mt-4 fs-5">Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </div>
    </div>

<?php
include('includes/footer.php');
include('functions/message.php');
if(isset($_SESSION['auth']))
{
    redirect("info", "You are already Logged In USER!");
    header("Location: index.php");
    exit();
}
?>