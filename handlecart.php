<?php
session_start();
include('config/dbconnect.php');

if(isset($_SESSION['auth']))
{
    if(isset($_POST['scope']))
    {
        $scope = $_POST['scope'];
        switch($scope)
        {
            case "add":
                $menu_id = $_POST['menu_id'];
                $menu_qty = $_POST['menu_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $check_existing_cart = "SELECT * FROM cart WHERE menu_id='$menu_id' AND user_id='$user_id' ";
                $check_existing_cart_run = mysqli_query($con, $check_existing_cart);

                if(mysqli_num_rows($check_existing_cart_run) > 0)
                {
                    echo "existing";
                }
                else
                {
                    $insert_query = "INSERT INTO cart(user_id,menu_id,menu_qty) VALUES('$user_id', '$menu_id', '$menu_qty')";
                    $insert_query_run = mysqli_query($con, $insert_query);
    
                    if($insert_query_run)
                    {
                        echo 201;
                    }
                    else
                    {
                        echo 500;
                    }
                }

                break;

            case "update":
                $menu_id = $_POST['menu_id'];
                $menu_qty = $_POST['menu_qty'];

                $user_id = $_SESSION['auth_user']['user_id'];

                $check_existing_cart = "SELECT * FROM cart WHERE menu_id='$menu_id' AND user_id='$user_id' ";
                $check_existing_cart_run = mysqli_query($con, $check_existing_cart);

                if(mysqli_num_rows($check_existing_cart_run) > 0)
                {
                    $update_menu_cart = "UPDATE cart SET menu_qty='$menu_qty' WHERE menu_id='$menu_id' AND user_id='$user_id' ";
                    $update_menu_cart_run = mysqli_query($con, $update_menu_cart);

                    if($update_menu_cart_run)
                    {
                        echo "MenuItem quantity updated!";
                    }
                    else
                    {
                        echo "MenuItem not existed!";
                    }
                }
                else
                {
                    echo "Something went wrong!";
                }

                break;


            case "delete":
                $cart_id = $_POST['cart_id'];
                
                $user_id = $_SESSION['auth_user']['user_id'];

                $check_existing_cart = "SELECT * FROM cart WHERE cart_id='$cart_id' AND user_id='$user_id' ";
                $check_existing_cart_run = mysqli_query($con, $check_existing_cart);

                if(mysqli_num_rows($check_existing_cart_run) > 0)
                {
                    $delete_cart_menuitem = "DELETE FROM cart WHERE cart_id='$cart_id' "; 
                    $delete_cart_menuitem_run = mysqli_query($con, $delete_cart_menuitem);

                    if($delete_cart_menuitem_run)
                    {
                        echo 200;
                    }
                    else
                    {
                        echo "MenuItem not existed!";
                    }
                }
                else
                {
                    echo "Something went wrong!";
                }

                break;

            default:
                echo 500;
        }
    }
}
else
{
    echo 401;
}

?>