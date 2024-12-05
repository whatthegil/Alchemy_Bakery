<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cake_id = $_POST['cake_id'];
    $sql = "DELETE FROM Cakes WHERE cake_id = $cake_id";

    if ($conn->query($sql) === TRUE) {
        echo "Cake deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>