<?php
session_start();

// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'alchemy_bakery';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to Cart functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_price = $_POST['item_price'];
    $item_quantity = $_POST['item_quantity']; // User-specified quantity

    $item_exists = false;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $item_id) {
            $item['quantity'] += $item_quantity;
            $item_exists = true;
            break;
        }
    }

    if (!$item_exists) {
        $_SESSION['cart'][] = [
            'id' => $item_id,
            'name' => $item_name,
            'price' => $item_price,
            'quantity' => $item_quantity,
        ];
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Calculate cart count
$cart_count = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_count += $item['quantity'];
}

// Fetch categories
$categories_sql = "SELECT * FROM categories";
$categories_result = $conn->query($categories_sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu | Alchemy Bakery</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://shopify.com/css/unicons.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
                        <a class="nav-link dropdown-toggle" href="menu.php" id="menuDropdown" role="button" data-bs-toggle="dropdown">Menu</a>
                        <div class="dropdown-menu">
                            <div class="container menu-container">
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <a href="menu/cakes.php">
                                            <img src="images/cakes.png" alt="Cakes">
                                        </a>
                                        <p>Cakes</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/cake_slice.php">
                                            <img src="images/cake_slice.png" alt="Cake Slice">
                                        </a>
                                        <p>Cake Slice</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/rolls.php">
                                            <img src="images/rolls.png" alt="Rolls">
                                        </a>
                                        <p>Cake Rolls</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/dedication_cakes.php">
                                            <img src="images/dedication_cakes.png" alt="Dedication Cakes">
                                        </a>
                                        <p>Dedication Cakes</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/sweet_pastries.php">
                                            <img src="images/sweet_pastries.png" alt="Sweet Pastries">
                                        </a>
                                        <p>Pastries</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/cookies.php">
                                            <img src="images/cookies.png" alt="Cookies">
                                        </a>
                                        <p>Cookies</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/empanadas.php">
                                            <img src="images/empanadas.png" alt="Empanadas">
                                        </a>
                                        <p>Empanadas</p>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <a href="menu/cupcakes.php">
                                            <img src="images/cupcakes.png" alt="Cupcakes">
                                        </a>
                                        <p>Cupcakes</p>
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
                            <a class="nav-link" href="service.php">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="accounts.php">Accounts</a>
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

    <header class="text-center py-5 bg-danger text-white">
        <h3 class="text-uppercase">Alchemy Bakery</h3>
        <h1 class="fg-bold text-white">Our Menu</h1>
    </header>

    <section class="py-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                <a href="cakes.php">
                        <img src="images/cakes.png" alt="Cakes" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Cakes</h5>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="cake_slice.php">
                    <img src="images/cake_slice.png" alt="Cake Slice" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Cake Slice</h5>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="rolls.php">
                    <img src="images/rolls.png" alt="Cake Rolls" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Cake Rolls</h5>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="dedication_cakes.php">
                    <img src="images/dedication_cakes.png" alt="Dedication Cakes" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Dedication Cakes</h5>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="sweet_pastries.php">
                    <img src="images/sweet_pastries.png" alt="Sweet Pastries" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Pastries</h5>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="cookies.php">
                    <img src="images/cookies.png" alt="Cookies" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Cookies</h5>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="empanadas.php">
                        <img src="images/empanadas.png" alt="Empanadas" class="img-fluid rounded">
                    </a>
                    <h5 class="mt-3">Empanadas</h5>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="text-center py-4">
        <div class="container">
          <hr>
            <p>📞 +639281414151 | ✉️ alchemybaker1@gmail.com |📍 Nabua, Camarines Sur | &copy; All Rights Reserved 2024</p>
          <div class="social-icons">
              <a href="#"><img src="images/facebook.png" alt="Facebook"></a>
              <a href="#"><img src="images/instagram-icon.png" alt="Instagram"></a>
              <a href="#"><img src="images/tiktok_icon.png" alt="TikTok"></a>
              <a href="#"><img src="images/youtube-icon.png" alt="YouTube"></a>
          </div>
        </div>
      </footer>

      <!-- Bootstrap JS and dependencies -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    </body>
</html>