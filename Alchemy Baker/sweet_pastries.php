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
</head>

    <?php include 'templates/header.php'; ?>

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

    <?php include 'templates/footer.php'; ?>
<html>