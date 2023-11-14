<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: dashboard.php"); 
    exit(); 
} 

?>

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>BoltCabs</title>
<body>
    <header>
        <a href="index.php" class = "logo">BoltCabs</a>
        <ul class="nav-page">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul>
        <?php
        if(isset($_SESSION['email'])){
           echo '<li><a href="logout.php" class="logout">LOGOUT</a></li>';
        }
        else{
        echo '<li><a href="login.php" class="login">Log In</a></li>';
        echo '<li><a href="signup.php" class="signup">Sign Up</a></li>';
        }
        ?>
        </ul>
    </header>
    
    <section class="banner">
        
        <div class="image-container" >
            <h1 class="slogan">Rent A Cab Now!</h1>
            <a href="signup.php" class="rentnow">Get Started</a>
        </div>
    </section>
    <footer>
    <div class="footer-content">
       
        <div class="social-icons">
            <a href="#" ><i class="fab fa-facebook"></i></a>
            <a href="#" ><i class="fab fa-instagram"></i></a>
            <a href="#" ><i class="fab fa-linkedin"></i></a>
            <a href="#" ><i class="fab fa-twitter"></i></a>
        </div>
        <div class="footer-links">
            <a href="#"><i class="fas fa-file-alt"></i> Terms of Service</a>
            <a href="#"><i class="fas fa-shield-alt"></i> Privacy Policy</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
            <a href="#"><i class="fas fa-question-circle"></i> FAQ</a>
            <a href="#"><i class="fas fa-phone-alt"></i> Customer Support</a>
        </div>
    </div>
</footer>

</body>
</html>