<?php
session_start();
include('config/dbconnect.php');
include('functions/message.php');
if(!isset($_SESSION['auth']))
{
    redirect("error", "Login to continue!");
    header("Location: login.php");
    exit();
}

// authenticated user can access
if(isset($_SESSION['auth']))
{
    if(isset($_POST['placeOrderBtn']))
    {
        $username = $_POST['username'];
        $email = $_POST['emailId'];
        $phone = $_POST['contact'];
        $address = $_POST['address'];
        $payment_mode = $_POST['payment_mode'];
        $payment_id = $_POST['payment_id'];

        if($username=="" || $email=="" || $phone=="" || $address=="")
        {
            redirect("error", "All fields are mandatory!");
            header("Location: checkout.php");
            exit();    
        }

        // only logged in user can see cart items
        $user_id = $_SESSION['auth_user']['user_id'];
                            
        // fetch data from cart and menu tables
        $fetch_cart_item = "SELECT ct.cart_id AS cid, ct.menu_id, ct.menu_qty, mn.menu_id as mid, mn.name, mn.image, mn.price FROM cart ct, menu mn WHERE ct.menu_id=mn.menu_id AND ct.user_id='$user_id' ORDER BY ct.cart_id DESC";
        $fetch_cart_item_run = mysqli_query($con, $fetch_cart_item);

        $total_price = 0;

        foreach($fetch_cart_item_run as $cartitems)
        {
            $total_price += $cartitems['price'] * $cartitems['menu_qty'];
        }

        $ordering_no = "orderno".rand(11111,99999);

        $insert_query = "INSERT INTO orders(ordering_no, user_id, username, email, phone, address, total_price, payment_mode, payment_id) VALUES('$ordering_no', '$user_id', '$username', '$email', '$phone', '$address', '$total_price', '$payment_mode', '$payment_id')";
        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            // gives last order id of the user in orders table
            $order_id = mysqli_insert_id($con);

            foreach($fetch_cart_item_run as $cartitems)
            {
                $menu_id = $cartitems['menu_id'];
                $menu_qty = $cartitems['menu_qty'];   
                $menu_price = $cartitems['price'];
                
                $insert_menu_query = "INSERT INTO order_items(order_id, menu_id, menu_qty, menu_price) VALUES('$order_id', '$menu_id', '$menu_qty', '$menu_price')";
                $insert_menu_query_run = mysqli_query($con, $insert_menu_query);
            }

            $delete_cart_query = "DELETE FROM cart WHERE user_id='$user_id' ";
            $delete_cart_query_run = mysqli_query($con, $delete_cart_query);

            redirect("success", "Order placed successfully!");
            header("Location: my-orders.php");
            exit();

        }

    }
}
else
{
    redirect("error", "Login to continue!");
    header("Location: login.php");
    exit();
}

?>