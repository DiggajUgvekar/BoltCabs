<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./style/style.css">
    <title>Contact BoltCabs</title>
    <style>
        .contact-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .contact-form {
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        max-width: 600px;
        text-align: left;
    }

    .contact-form label {
        display: block;
        font-weight: bold;
        margin-top: 10px;
    }

    .contact-form input[type="text"],
    .contact-form input[type="email"],
    .contact-form textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .contact-form button {
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
    }

    .contact-form button:hover {
        background-color: #218838;
    }

    .contact-image {
        max-width: 50%;
        border-radius: 5px;
    }

    .contact-details {
        background-color: #f5f5f5;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        max-width: 300px;
        text-align: left;
        margin: 20px auto;
    }

    .contact-details h2 {
        font-size: 24px;
        margin: 0 0 15px;
        color: #333; 
    }

    .contact-details p {
        margin: 0 0 10px;
        color: #555; 
    }

    .contact-details strong {
        color: #333; 
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
    <br><br><br><br>
    <div class="contact-container">
        <form class="contact-form">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Submit</button>
        </form>

        
        <img src="img/contactus.jpg" alt="Contact Us" class="contact-image">
    </div>
    <!-- Contact Details -->
    <div class="contact-details">
        <h2>Contact Details</h2>
        <p><strong>Address:</strong> 123 Main Street, City, Country</p>
        <p><strong>Phone:</strong> (123) 456-7890</p>
        <p><strong>Email:</strong> info@boltcabs.com</p>
    </div>
</body>
</html>
