<?php
include 'db_connection.php'; // Reuse your DB connection logic

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        // Insert into database
        $sql = "INSERT INTO Cakes (name, price, image_url) VALUES ('$name', '$price', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            echo "New cake added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>