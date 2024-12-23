<?php

function redirect($icon, $title)
{
    $_SESSION['message'] = [
        'icon' => $icon,
        'title' => $title
    ];
}

if(isset($_SESSION['message']))
{
    $message = $_SESSION['message'];
    echo "<script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        });
        Toast.fire({
            icon: '{$message['icon']}',
            title: '<h5>{$message['title']}</h5>'
        });
    </script>";
    unset($_SESSION['message']);
}

?>