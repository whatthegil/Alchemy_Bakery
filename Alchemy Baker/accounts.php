<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password)&& !is_numeric($email)) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        
        if($result = mysqli_query($conn, $query)){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);

                if($userData['password'] == $password){
                    header('Location: index.php');
                    die;
                }
            }
        }
            echo "<script type='text/javascript'>alert('Invalid username or password.')</script>";
    }
    else{
            echo "<script type='text/javascript'>alert('Please enter a valid username or password.')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accounts | Alchemy Bakery</title>
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

    <main>
        <section class="login">
            <div class="form-container">
                <form action="accounts.php" method="POST">
                    <h2>LOGIN</h2>
                    <input type="email"  id="username" name="username" placeholder="Mobile number or email" required>
                    
                    <input class="password" type="password" id="password" name="password" placeholder="Password" required>

                    <button type="submit">Login</button>

                    <a href="#" class="forgot-password">Forgot Password?</a>

                    <p>Don't have an account? <a href="create-account.html" id="create-account-btn">Create one</a></p>
                    
                    <p>Or Sign Up using</p>

                    <a href="https://www.facebook.com/login.php?skip_api_login=1&api_key=150722575101290&kid_directed_site=0&app_id=150722575101290&signed_next=1&next=https%3A%2F%2Fwww.facebook.com%2Fv19.0%2Fdialog%2Foauth%3Fclient_id%3D150722575101290%26state%3D%257B%2522_sid%2522%253A%25226f377c36-c76a-1f69-0d34-a993941f0c32%2522%257D%26response_type%3Dcode%26sdk%3Dphp-sdk-5.7.0%26redirect_uri%3Dhttps%253A%252F%252Fapp.growave.io%252Flite2%252Fauth%252Ffcallback%26scope%3Demail%252Cpublic_profile%26ret%3Dlogin%26fbapp_pres%3D0%26logger_id%3D0cf9a3d9-104f-4fc4-a5b8-1753cbe58377%26tp%3Dunspecified&cancel_url=https%3A%2F%2Fapp.growave.io%2Flite2%2Fauth%2Ffcallback%3Ferror%3Daccess_denied%26error_code%3D200%26error_description%3DPermissions%2Berror%26error_reason%3Duser_denied%26state%3D%257B%2522_sid%2522%253A%25226f377c36-c76a-1f69-0d34-a993941f0c32%2522%257D%23_%3D_&display=page&locale=en_US&pl_dbl=0" class="facebook-button">
                    Facebook</a>
                    <a href="https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?response_type=code&access_type=offline&client_id=766683587460-nit6r0u35r0v9d3r1ft5uika3v22q5fi.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fapp.growave.io%2Flite2%2Fauth%2Fgconnect&state=%7B%22_sid%22%3A%226f377c36-c76a-1f69-0d34-a993941f0c32%22%2C%22shop%22%3A%22https%3A%5C%2F%5C%2Fthe-cakery-hk.myshopify.com%22%7D&scope=profile%20openid%20email&approval_prompt=force&include_granted_scopes=true&service=lso&o2v=1&ddm=1&flowName=GeneralOAuthFlow" class="google-button">
                    Google</a>
                </form>
            </div>
        </section>
    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
</body>
</html>
