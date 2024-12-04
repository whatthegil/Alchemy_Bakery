<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'alchemy_bakery';

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://shopify.com/css/unicons.css" rel="stylesheet">
    <style>
        nav {
            background-color: brown;
            padding: 10px;
            color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            width: 120px;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: bold;
            margin: 0 15px;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        .btn-start-order {
            background-color: #ff5722;
            color: white;
            font-weight: bold;
            border: none;
        }

        .btn-start-order:hover {
            background-color: #e64a19;
        }

        .search-bar {
            position: relative;
            max-width: 300px;
            margin-right: 15px;
        }

        .search-bar input {
            width: 100%;
            padding: 8px 35px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
        }

        .search-bar i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        .cart-icon {
            position: relative;
        }

        .cart-icon i {
            font-size: 24px;
            color: white;
        }

        @media (max-width: 768px) {
            .search-bar {
                margin: 10px 0;
                max-width: 100%;
            }

            .navbar-nav {
                text-align: center;
            }

            .menu {
                text-align: center;
            }
        }

        .dropdown-menu {
            width: 600px;
            padding: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .menu-container {
            text-align: center;
            max-width: 1200px;
        }

        .menu-container img {
            max-width: 80px;
            margin-bottom: 10px;
        }

        .menu-container .col {
            margin-bottom: 20px;
        }

        .btn-view-menu {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
        }

        .btn-view-menu:hover {
            background-color: #e0a800;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            height: 70vh;
            margin: 0;
            padding: 0;
            padding-top: 100px;
            background-color: #f9f9f9;
        }

        h4 {
            color: #555;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        .btn-danger {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #b71c1c;
        }

        @media (max-width: 768px) {
            .menu .category {
                text-align: center;
            }
        }

        footer {
            background-color: #f2f2f2;
            color: #000000;
            padding: 20px;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        footer hr {
            margin: 20px auto;
            border: none;
            border-top: 1px solid #ccc;
            width: 90%;
        }

        footer p {
            margin: 10px 0;
            color: #b00000;
        }

        footer a {
            color: #b00000;
            text-decoration: none;
            margin: 0 5px;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer .social-icons {
            margin-top: 10px;
        }

        footer .social-icons a img {
            width: 20px; /* Adjust icon size */
            height: 20px;
            margin: 0 5px;
        }

        .lead {
            font-size: 1.25rem;
        }

        h1.display-4 {
            font-weight: bold;
        }
        header {
            background-color: #b22222;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        .banner {
            background-color: #d32f2f;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .banner h1 {
            font-size: 2em;
            margin: 0;
        }
        .breadcrumb {
            margin-left: 50px;
            margin: 20px auto;
            text-align: center;
            font-size: 14px;
        }
        .breadcrumb a {
            text-decoration: none;
            color: #d32f2f;
        }
        .cake-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }
        .cake {
            width: 300px;
            text-align: center;
        }
        .cake img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .cake h3 {
            margin: 10px 0;
            font-size: 1.2em;
        }
        .btn-add-cart {
            display: inline-block;
            background-color: #ff9800;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }
        .btn-add-cart:hover {
            background-color: #e67e22;
        }
        .cart-container {
            margin-top: 30px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cart-footer {
            margin-top: 20px;
            padding: 10px 0;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
    <body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="Alchemy Bakery Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                            data-bs-toggle="dropdown">
                            Menu
                        </a>
                        <div class="dropdown-menu">
                            <div class="container menu-container">
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <a href="cakes.php">
                                        <img src="images/cakes.png" alt="Cakes">
                                        </a>
                                        <p>Cakes</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="cake_slice.php">
                                        <img src="images/cake_slice.png" alt="Cake Slice">
                                        </a>
                                        <p>Cake Slice</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="rolls.php">
                                        <img src="images/rolls.png" alt="Rolls">
                                        </a>
                                        <p>Cake Rolls</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="dedication_cakes.php">
                                        <img src="images/dedication_cakes.png" alt="Dedication Cakes">
                                        </a>
                                        <p>Dedication Cakes</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="sweet_pastries.php">
                                        <img src="images/sweet_pastries.png" alt="Sweet Pastries">
                                        </a>
                                        <p>Pastries</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="cookies.php">
                                        <img src="images/cookies.png" alt="Cookies">
                                        </a>
                                        <p>Cookies</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="empanadas.php">
                                        <img src="images/empanadas.png" alt="Empanadas">
                                        </a>
                                        <p>Empanadas</p>
                                    </div>
                                </div>
                                <a href="menu.php" class="btn btn-view-menu mt-3">View Full Menu</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="search-bar">
                        <input type="text" placeholder="Search">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="cart-icon">
                        <a href="cart.php">
                        <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <button class="btn btn-start-order ms-3">Order Now</button>
                </div>
            </div>
        </div>
    </nav>