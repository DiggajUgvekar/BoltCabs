<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./style/style.css">
    <title>About BoltCabs - Your Trusted Taxi Booking in Goa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    text-align: center;
}
.about-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 80vh;
}
.about-content {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    max-width: 800px;
    text-align: left;
    margin: 20px;
}

.about-content h1 {
    font-size: 28px;
    color: #333;
}

.about-content h2 {
    font-size: 24px;
    color: #555;
    margin-top: 20px;
}

.about-content p {
    margin: 10px 0;
    line-height: 1.5;
    color: #666;
}

.about-content ul {
    list-style: disc;
    padding-left: 20px;
    color: #666;
}

.about-content ul li {
    margin: 5px 0;
}

.about-content img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-top: 20px;
}



    </style>
</head>
<body>
    <header>
        <a href="index.php" class="logo">BoltCabs</a>
        <ul class="nav-page">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul>
            <?php
            session_start();
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
<br><br><br><br><br>

<div class="about-container">
    <div class="about-content">
        <h1>About BoltCabs</h1>
        <p>Welcome to BoltCabs, your premier taxi booking service in the beautiful paradise of Goa. We are here to make your travel experience not just convenient, but truly memorable. As your trusted transportation partner, we go above and beyond to ensure your safety, comfort, and satisfaction.</p>

        <img src="img/beach.png" alt="Goa Beach" />

        <h2>Our Commitment</h2>
<p>At BoltCabs, we are committed to providing top-quality taxi services that meet your every need. Our team of experienced and friendly drivers is dedicated to ensuring your journey is safe and enjoyable. We take pride in offering a fleet of comfortable and well-maintained taxi cars, each held to the highest standards.</p>

        <img src="img/taxi5.jpg" alt="Taxi Fleet" />

        <h2>Why Choose BoltCabs?</h2>
        <p>Choosing BoltCabs means choosing reliability, convenience, and peace of mind. Here are some of the reasons to book your ride with us:</p>
            <ul>
                <li>Easy Online Booking: Our user-friendly website make booking a cab a breeze.</li>
                <li>Punctuality: We understand the value of your time and guarantee on-time pickups and drop-offs.</li>
                <li>Clean and Safe: Our vehicles are well-maintained, clean, and equipped with safety features.</li>
                
            </ul>
        <img src="img/my.avif" alt="Goa Landscape" />

        <h2>Explore Goa with Us</h2>
        <p>Goa's stunning beaches, vibrant culture, and picturesque landscapes await you. BoltCabs is more than just a taxi service; we are your travel partner. Let us take you on a journey through the heart of Goa, ensuring you experience the best it has to offer.</p>

        <p>Thank you for choosing BoltCabs for your transportation needs. We look forward to serving you and making your time in Goa truly unforgettable.</p>
    </div>
</div>
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
