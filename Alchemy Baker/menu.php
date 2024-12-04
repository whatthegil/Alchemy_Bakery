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
<head>
    <title>Menu</title>
</head>
<html>

    <?php include 'templates/header.php'; ?>

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

    <?php include 'templates/footer.php'; ?>
</html>