// The following code is written for deleting the registered user 
$(document).ready(function () {
    
    $(document).on('click', '.delete_user_btn', function (e) {
        e.preventDefault();
        
        var id = $(this).val();
        //alert(id);

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this user!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0d6efd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "POST",
                url: "./code.php",
                data: {
                    'id':id,
                    'delete_user_btn':true
                },
                success: function (response) {
                    if(response == 200)
                    {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The user has been deleted.",
                            icon: "success"
                          });
                          $("#fetchUserRecords").load(location.href + " #fetchUserRecords");
                    }
                    else
                    {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong.",
                            icon: "error"
                          });
                    }
                }
              });


            }
          });

    });

});

// The following code is written for deleting the category 
$(document).ready(function () {
    
    $(document).on('click', '.delete_category_btn', function (e) {
        e.preventDefault();
        
        var cat_id = $(this).val();
        //alert(id);

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this category!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0d6efd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "POST",
                url: "./code.php",
                data: {
                    'cat_id':cat_id,
                    'delete_category_btn':true
                },
                success: function (response) {
                    if(response == 100)
                    {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The category has been deleted.",
                            icon: "success"
                          });
                          $("#fetchCategoryData").load(location.href + " #fetchCategoryData");
                    }
                    else
                    {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong.",
                            icon: "error"
                          });
                    }
                }
              });


            }
          });

    });

});

// The following code is written for deleting the menu item 
$(document).ready(function () {
    
    $(document).on('click', '.delete_menu_btn', function (e) {
        e.preventDefault();
        
        var menu_id = $(this).val();
        //alert(id);

        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this category!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0d6efd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "POST",
                url: "./code.php",
                data: {
                    'menu_id':menu_id,
                    'delete_menu_btn':true
                },
                success: function (response) {
                    if(response == 100)
                    {
                        Swal.fire({
                            title: "Deleted!",
                            text: "The menu item has been deleted.",
                            icon: "success"
                          });
                          $("#fetchMenuItemData").load(location.href + " #fetchMenuItemData");
                    }
                    else
                    {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong.",
                            icon: "error"
                          });
                    }
                }
              });


            }
          });

    });

});
