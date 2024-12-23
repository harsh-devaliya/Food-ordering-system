<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <!-- Restaurant LOGO -->
            <img src="./res-img/logo2.jpg" alt="logo" width="145px" class="rounded">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto me-4 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my-orders.php">Orders</a>
                </li>
                <?php
                if (isset($_SESSION['auth'])) {    // if user logged in
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $_SESSION['auth_user']['username']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="#">My Orders</a></li> -->
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                <?php
                } else {                         // if user not logged in
                ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sign In
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
</nav>