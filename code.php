<?php
session_start();
include('config/dbconnect.php');
include('functions/message.php');

if(isset($_POST['register_btn']))
{
    $username = mysqli_real_escape_string($con, $_POST['username']);    
    $email = mysqli_real_escape_string($con, $_POST['email']);    
    $phoneno = mysqli_real_escape_string($con, $_POST['phoneno']);    
    $password = mysqli_real_escape_string($con, md5($_POST['password']));    
    $cpassword = mysqli_real_escape_string($con, md5($_POST['cpassword']));    

    $check_email_query = "select * from users where username='$username' or email='$email' ";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if($username=="" || $email=="" || $phoneno=="" || $password=="" || $cpassword=="")
    {
        redirect("error", "All fields are mandatory!");
        header("Location: register.php");
        exit();
    }
    elseif(mysqli_num_rows($check_email_query_run) > 0)
    {
        redirect("error", "Username or Email already exists!");
        header("Location: register.php");
        exit();
    }
    else
    {
        if($password == $cpassword)
        {
            $insert_query = "INSERT INTO users(username,email,phoneno,password) VALUES('$username','$email','$phoneno','$password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if($insert_query_run)
            {
                redirect("success", "Register Successful!");
                header("Location: login.php");
                exit();
            }
            else
            {
                redirect("error", "Something went wrong!");
                header("Location: register.php");
                exit();
            }
        }
        else
        {
            redirect("error", "Password do not match!");
            header("Location: register.php");
            exit();
        }
    }
}

elseif(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, md5($_POST['password']));


    // POST Method parameter for captcha
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
    {

        // Copy the secret key of captcha
        $secretKeyOfCaptcha = '6LdoM08qAAAAAIAQ5GX80i54W-oRA73Yiab9HG85';

        // The site link is used for verify the user captcha
        // secret => The shared key between your site and reCAPTCHA.
        // response	=> The user response token provided by the reCAPTCHA client-side integration on your site.
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKeyOfCaptcha.'&response='.$_POST['g-recaptcha-response']);

        // json code take from the site
        $getResponse = json_decode($verifyResponse);

        // success returns the captcha is true or false
        if($getResponse->success)
        {

            $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
            $login_query_run = mysqli_query($con, $login_query);
        
            if(empty($email) || empty($password))
            {
                redirect("error", "All fields are mandatory!");
                header("Location: login.php");
                exit();
            }
            elseif(mysqli_num_rows($login_query_run) > 0)
            {
                $_SESSION['auth'] = true;
        
                $userdata = mysqli_fetch_array($login_query_run);
                $userid = $userdata['id'];
                $username = $userdata['username'];
                $useremail = $userdata['email'];
                $role_as = $userdata['role'];
        
                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'username' => $username,
                    'email' => $useremail 
                ];
        
                $_SESSION['role'] = $role_as;
                if($role_as == 1)
                {
                    redirect("success", "Welcome to Dashboard!"); 
                    header("Location: ./admin/index.php");
                    exit();
                }
                else
                {
                    redirect("success", "Logged in successful!");
                    header("Location: index.php");
                    exit();
                }
            }
            else
            {
                redirect("error", "Invalid Email or Password!");
                header("Location: login.php");
                exit();
            }
    

        }
        else
        {
            redirect("error", "Something went wrong!");
            header("Location: login.php");
            exit();    
        }

    }
    else
    {
        redirect("error", "Error in Captcha Verification!");
        header("Location: login.php");
        exit();
    }



}


?>