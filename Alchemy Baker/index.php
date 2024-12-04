<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'alchemy_bakery';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Alchemy Bakery</title>
    </head>

    <?php include 'templates/header.php'; ?>

        <div class="hero container text-center mt-5 bg-grey">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h4 class="text-uppercase">Try Our New</h4>
                    <h1 class="display-4 fw-bold">Tiramisu Cake</h1>
                    <p class="lead">Enjoy layers of coffee-soaked white chiffon cake filled with creamy mascarpone!</p>
                    <a href="menu.php" class="btn btn-danger btn-lg">Order Now</a>
                </div>
                <div class="col-md-6">
                    <img src="images/tiramisu_cake.jpg" alt="Tiramisu Cake" class="img-fluid rounded">
                </div>
            </div>
        </div>

        <div class="container text-center mt-5 bg-light">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="images/spanish_bread.jpg" alt="Spanish Bread" class="img-fluid rounded">
                </div>
                <div class="col-md-6 text-start">
                    <h4 class="text-uppercase">Our Newest Pastry is Here</h4>
                    <h1 class="display-4 fw-bold">Spanish Bread</h1>
                    <p class="lead">Fluffy buttery bread rolls with a slightly sweet filling and sprinkled with breadcrumbs.</p>
                    <a href="menu.php" class="btn btn-danger btn-lg">Order Now</a>
                </div>
            </div>
        </div>

        <?php include 'templates/footer.php'; ?>
</html>