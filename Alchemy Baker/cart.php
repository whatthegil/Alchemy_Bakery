<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle cart actions (add, remove, update quantity)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update item quantity
    if (isset($_POST['update_quantity'])) {
        $item_id = intval($_POST['item_id']);
        $new_quantity = intval($_POST['quantity']);

        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $item_id) {
                if ($new_quantity > 0) {
                    $item['quantity'] = $new_quantity;
                } else {
                    // Remove item if quantity is 0
                    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($cart_item) use ($item_id) {
                        return $cart_item['id'] != $item_id;
                    });
                }
                break;
            }
        }
    }

    // Remove item from cart
    if (isset($_POST['remove_item'])) {
        $item_id = intval($_POST['item_id']);
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($cart_item) use ($item_id) {
            return $cart_item['id'] != $item_id;
        });
    }

    // Clear entire cart
    if (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = array();
    }

    // Redirect to prevent resubmission after POST
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Handle item addition (GET request)
if (isset($_GET['add_item'])) {
    $item_id = intval($_GET['add_item']);
    $item_name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'Unnamed Item';
    $item_price = isset($_GET['price']) ? floatval($_GET['price']) : 0.0;

    // Check if the item is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $item_id) {
            $item['quantity'] += 1; // Increase quantity
            $found = true;
            break;
        }
    }

    // If item is not found, add it to the cart
    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $item_id,
            'name' => $item_name,
            'price' => $item_price,
            'quantity' => 1
        ];
    }

    // Redirect to the cart page
    header("Location: cart.php");
    exit();
}

// Calculate cart totals
$total_items = 0;
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_items += $item['quantity'];
    $total_price += $item['quantity'] * $item['price'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
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
        <h1 class="fg-bold text-white">Your Cart</h1>
    </header>

    <div class="container cart-container">
        <?php if ($total_items > 0): ?>
            <div class="cart-header d-flex justify-content-between align-items-center mb-4">
                <h5>Items in Cart: <?php echo $total_items; ?></h5>
                <form method="POST">
                    <button type="submit" name="clear_cart" class="btn btn-danger btn-sm">Clear Cart</button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mt-4 cart-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-center">Subtotal</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td class="text-center">₱<?php echo number_format($item['price'], 2); ?></td>
                                <td class="text-center">
                                    <form method="POST" class="d-inline-block">
                                        <input type="hidden" name="item_id" value="<?php echo intval($item['id']); ?>">
                                        <input type="number" name="quantity" value="<?php echo intval($item['quantity']); ?>" min="0" class="form-control form-control-sm d-inline-block w-50 text-center">
                                        <button type="submit" name="update_quantity" class="btn btn-primary btn-sm mt-2 mt-md-0">Update</button>
                                    </form>
                                </td>
                                <td class="text-center">₱<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                                <td class="text-center">
                                    <form method="POST">
                                        <input type="hidden" name="item_id" value="<?php echo intval($item['id']); ?>">
                                        <button type="submit" name="remove_item" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="cart-footer d-flex justify-content-between align-items-center">
                <h4>Total: ₱<?php echo number_format($total_price, 2); ?></h4>
                <a href="#" class="btn btn-success">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Your cart is empty. <a href="menu.php" class="alert-link">Go to Menu</a> to add items.
            </div>
        <?php endif; ?>
    </div>
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