<?php
// Database connection
$host = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "alchemy_bakery"; // The database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cakes from the database
$sql = "SELECT pastry_id, name, price, image_url FROM sweetpastries";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Alchemy Bakery - Pastries</title>
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
        <h1 class="fg-bold text-white">Pastries</h1>
    </header>
    
    <div class="cake-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="cake">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="price">₱<?php echo number_format($row['price'], 2); ?></p>
                    <form onsubmit="addToCart(event, '<?php echo htmlspecialchars($row['name']); ?>', <?php echo $row['price']; ?>)">
                        <button type="submit" class="btn-add-cart">Add to Cart</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No cakes are available at the moment.</p>
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
<html>