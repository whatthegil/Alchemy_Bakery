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
</head>
<?php include "templates/header.php"; ?>

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

    <?php include "templates/footer.php"; ?>
</html>