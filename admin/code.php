<?php
session_start();
include('config/dbconnect.php');
include('../functions/message.php');


// The following code is written for adding the categories.
if(isset($_POST['add_category_btn']))
{
    $cate_name = $_POST['name'];
    $cate_slug = $_POST['slug'];
    $cate_description = $_POST['description'];
    $cate_status = isset($_POST['status']) ? '1' : '0';  // if it is checked, return 1
    $cate_populate = isset($_POST['popular']) ? '1' : '0';  // if it is checked, return 1

    $cate_image = $_FILES['image']['name'];

    $upload_img_path = "../uploads";   // store all category images

    $image_extension = pathinfo($cate_image, PATHINFO_EXTENSION);
    // time() function take current time as an image name
    $filename = time() . '.' . $image_extension; 


    if($cate_name != "" || $cate_slug != "" || $cate_description != "" || $cate_image != "")
    {
        $cate_insert_query = "INSERT INTO categories(name,slug,description,image,status,popular) VALUES('$cate_name','$cate_slug','$cate_description','$filename','$cate_status','$cate_populate')";
        $cate_insert_query_run = mysqli_query($con, $cate_insert_query);

        if($cate_insert_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_img_path.'/'.$filename);

            redirect("success","Categroy added successful!");
            header("Location: view_category.php");
            exit();
        }
        else
        {
            redirect("error","Something went wrong!");
            header("Location: add_category.php");
            exit();
        }
    }
    else
    {
        redirect("error","All fields are required!");
        header("Location: add_category.php");
        exit();
    }
}

// The following code is written for updating the categories.
elseif(isset($_POST['edit_category_btn']))
{
    // new category id, fetch from edit_category.php page
    $category_id = $_POST['category_id']; 
    $cate_name = $_POST['name']; 
    $cate_slug = $_POST['slug']; 
    $cate_description = $_POST['description']; 
    $cate_status = isset($_POST['status']) ? '1' : '0';  // if it is checked, return 1
    $cate_populate = isset($_POST['popular']) ? '1' : '0';  // if it is checked, return 1 

    // Here, user can add new image, then store in database table
    $new_category_image = $_FILES['image']['name'];
    // Here, user can already added image at create category time, he does not want to change it.
    $old_category_image = $_POST['old_cat_image'];

    if($new_category_image != "")
    {
        $image_extension = pathinfo($new_category_image, PATHINFO_EXTENSION);
        // time() function take current time as an image name
        $update_filename = time() . '.' . $image_extension; 
    }
    else
    {
        $update_filename = $old_category_image;
    }

    $upload_img_path = "../uploads";   // store all category images

    $update_category_query = "UPDATE categories SET name='$cate_name', slug='$cate_slug', description='$cate_description', status='$cate_status', popular='$cate_populate', image='$update_filename' WHERE cat_id='$category_id' ";
    $update_category_query_run = mysqli_query($con, $update_category_query);

    if($cate_name != "" || $cate_slug != ""|| $cate_description != "")
    {
        if($update_category_query_run)
        {
            if($_FILES['image']['name'] != "")
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $upload_img_path.'/'.$update_filename);

                // Here, file_exists() functions checks the old_category_image is exists or not, which is added at create category time.
                if(file_exists("../uploads/".$old_category_image))
                {
                    // Here, unlink() function deletes the old_category_image where user can chage it, where adds new_category_image. 
                    unlink("../uploads/".$old_category_image);
                }
            }

            redirect("success","Category updated successful!");
            header("Location: view_category.php");
            exit();
        }
        else
        {
            redirect("error","Something went wrong!");
            header("Location: edit_category.php?cat_id=$category_id");
            exit();
        }
    }
    else
    {
        redirect("error","All fields are mandatory!");
        header("Location: edit_category.php?cat_id=$category_id");
        exit();
    }

}

// The following code is written for deleting the registered users.
elseif(isset($_POST['delete_user_btn']))
{
    $user_id = mysqli_real_escape_string($con, $_POST['id']);

    $select_query = "SELECT * FROM users";
    $select_query = mysqli_query($con, $select_query);

    $delete_query = "DELETE FROM users WHERE id='$user_id' "; 
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        echo 200;
    }
    else
    {
        echo 500;
    }

}

// The following code is written for deleting the categories.
elseif(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['cat_id']);

    $fetch_category = "SELECT * FROM categories WHERE cat_id='$category_id' ";
    $fetch_category_run = mysqli_query($con, $fetch_category);
    $category_data = mysqli_fetch_array($fetch_category_run);
    $upload_category_image = $category_data['image'];
    
    $delete_category = "DELETE FROM categories WHERE cat_id='$category_id' ";
    $delete_category_run = mysqli_query($con, $delete_category);

    if($delete_category_run)
    {
        // Here, file_exists() functions checks the upload_category_image is exists or not, which is added at create category time.
        if(file_exists("../uploads/".$upload_category_image))
        {
            // Here, unlink() function deletes the upload_category_image where user can chage it, where adds new_category_image. 
            unlink("../uploads/".$upload_category_image);
        }   

        // assets/bootstrap/js/delete_records.js
        echo 100;
    }
    else
    {
        echo 400;
    }
}

// The following code is written for adding the menu items.
elseif(isset($_POST['add_menu_btn']))
{
    $category_id = $_POST['category_id'];
    $menu_name = $_POST['name']; 
    $menu_slug = $_POST['slug']; 
    $menu_description = $_POST['description'];
    $menu_price = $_POST['price'];
    $menu_status = isset($_POST['status']) ? '1' : '0';  // if it is checked, return 1
    $menu_populate = isset($_POST['popular']) ? '1' : '0';   // if it is checked, return 1

    $menu_image = $_FILES['image']['name'];

    $upload_img_path = "../uploads";   // store all menu images

    $image_extension = pathinfo($menu_image, PATHINFO_EXTENSION);
    // time() function take current time as an image name
    $filename = time() . '.' . $image_extension; 


    if($category_id != "" || $menu_name != "" || $menu_slug != "" || $menu_description != "" || $menu_price != "" || $menu_image != "")
    {
        $menu_insert_query = "INSERT INTO menu(cat_id,name,slug,description,price,status,popular,image) VALUES('$category_id','$menu_name','$menu_slug','$menu_description','$menu_price','$menu_status','$menu_populate','$filename') ";
        $menu_insert_query_run = mysqli_query($con, $menu_insert_query);

        if($menu_insert_query_run)
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $upload_img_path.'/'.$filename);

            redirect("success","Menu Item added successful!");
            header("Location: view_menu.php");
            exit();
        }
        else
        {
            redirect("error","Something went wrong!");
            header("Location: add_menu.php");
            exit();
        }
    }
    else
    {
        redirect("error","All fields are required!");
        header("Location: add_menu.php");
        exit();
    }

}

// The following code is written for updating the menu items.
elseif(isset($_POST['edit_menu_btn']))
{
    $menu_id = $_POST['menu_id'];
    $category_id = $_POST['category_id'];
    $menu_name = $_POST['name']; 
    $menu_slug = $_POST['slug']; 
    $menu_description = $_POST['description'];
    $menu_price = $_POST['price'];
    $menu_status = isset($_POST['status']) ? '1' : '0';  // if it is checked, return 1
    $menu_populate = isset($_POST['popular']) ? '1' : '0';   // if it is checked, return 1

    // Here, user can upload new image, then store in database table
    $new_menu_image = $_FILES['image']['name'];
    // Here, user can already uploaded image at create menu item time, he does not want to change it
    $old_menu_image = $_POST['old_menu_image']; 

    if($new_menu_image != "")
    {
        $image_extension = pathinfo($new_menu_image, PATHINFO_EXTENSION);
        // time() function take current time as an image name
        $update_filename = time() . '.' . $image_extension; 
    }
    else
    {
        $update_filename = $old_menu_image;
    }

    $upload_img_path = "../uploads";   // store all menu images

    $update_menu_query = "UPDATE menu SET cat_id='$category_id', name='$menu_name', slug='$menu_slug', description='$menu_description', price='$menu_price', status='$menu_status', popular='$menu_populate', image='$update_filename' WHERE menu_id='$menu_id' ";
    $update_menu_query_run = mysqli_query($con, $update_menu_query);

    if($menu_name != "" || $menu_slug != ""|| $menu_description != "" || $menu_price != "")
    {
        if($update_menu_query_run)
        {
            if($_FILES['image']['name'] != "")
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $upload_img_path.'/'.$update_filename);

                // Here, file_exists() function checks the old_menu_image is exists or not, which is uploaded at create menu time.
                if(file_exists("../uploads/".$old_menu_image))
                {
                    // Here, unlink() function deletes the old_menu_image where user can chage it, where adds new_menu_image. 
                    unlink("../uploads/".$old_menu_image);
                }
            }

            redirect("success","Menu Item updated successful!");
            header("Location: view_menu.php");
            exit();
        }
        else
        {
            redirect("error","Something went wrong!");
            header("Location: edit_menu.php?menu_id=$menu_id");
            exit();
        }
    }
    else
    {
        redirect("error","All fields are mandatory!");
        header("Location: edit_menu.php?menu_id=$menu_id");
        exit();
    }    

}

// The following code is written for deleting the menu items.
elseif(isset($_POST['delete_menu_btn']))
{
    $menu_id = mysqli_real_escape_string($con, $_POST['menu_id']);

    $fetch_menuitem = "SELECT * FROM menu WHERE menu_id='$menu_id' ";
    $fetch_menuitem_run = mysqli_query($con, $fetch_menuitem);
    $menuitem_data = mysqli_fetch_array($fetch_menuitem_run);
    $upload_menuitem_image = $menuitem_data['image'];
    
    $delete_menuitem = "DELETE FROM menu WHERE menu_id='$menu_id' ";
    $delete_menuitem_run = mysqli_query($con, $delete_menuitem);

    if($delete_menuitem_run)
    {
        // Here, file_exists() functions checks the upload_menuitem_image is exists or not, which is uploaded at create menuitem time.
        if(file_exists("../uploads/".$upload_menuitem_image))
        {
            // Here, unlink() function deletes the upload_menuitem_image where user can chage it, where uploads new_menu_image. 
            unlink("../uploads/".$upload_menuitem_image);
        }   
        
        // assets/bootstrap/js/delete_records.js
        echo 100;
    }
    else
    {
        echo 400;
    }
}


// the following code is written for updating the status of user orders in all_orders.php
elseif(isset($_POST['updateOrderDetails']))
{
    $ordering_no = $_POST['ordering_no'];
    $order_status = $_POST['order_status'];
    $payment_id = isset($_POST['payment_status']) ? '1' : '0';
    
    $update_view_order = "UPDATE orders SET status='$order_status', payment_id='$payment_id' WHERE ordering_no='$ordering_no' ";
    $update_view_order_run = mysqli_query($con, $update_view_order);

    redirect("success","Order updated successfully!");
    header("Location: all_orders.php");
    exit();
    
}


?>