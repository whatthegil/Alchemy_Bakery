<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cake_id = $_POST['cake_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Check if a new image was uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image["name"]);
        move_uploaded_file($image["tmp_name"], $target_file);

        $sql = "UPDATE Cakes SET name = '$name', price = '$price', image_url = '$target_file' WHERE cake_id = $cake_id";
    } else {
        $sql = "UPDATE Cakes SET name = '$name', price = '$price' WHERE cake_id = $cake_id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Cake updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>