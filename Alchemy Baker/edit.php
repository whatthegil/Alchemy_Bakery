<?php
include 'db_connection.php';

if (isset($_GET['cake_id'])) {
    $cake_id = $_GET['cake_id'];
    $sql = "SELECT * FROM Cakes WHERE cake_id = $cake_id";
    $result = $conn->query($sql);
    $cake = $result->fetch_assoc();
}
?>
<form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="cake_id" value="<?php echo $cake['cake_id']; ?>">
    <input type="text" name="name" value="<?php echo $cake['name']; ?>">
    <input type="number" step="0.01" name="price" value="<?php echo $cake['price']; ?>">
    <input type="file" name="image">
    <button type="submit">Update Cake</button>
</form>
