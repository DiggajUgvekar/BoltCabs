<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="./style/login.css">
    <script src="https://kit.fontawesome.com/df94d1352d.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <a href="index.php" class = "logo">BoltCabs</a>
        <ul class="nav-page">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul>
        <li><a href="login.php" class="login">Log In</a></li>
        <li><a href="signup.php" class="signup">Sign Up</a></li>
        </ul>
    </header>
    
    <div class="container">
        <div class="formbox">
            <h1 id="title">Sign up</h1>
            <form>
                <div class="input-group">
                    <div class="input-field" id="namefield">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="nameinput" placeholder="Name" >
                    </div>

                    <div class="input-field" id="phonefield">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" class="phoneno" placeholder="Phone number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" >
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" required>
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" required>
                    </div>

                    <p>Forgot password <a href="#"><u> Click Here!</u></a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupbtn">Sign Up</button>                   
                    <button type="submit" id="signinbtn" class="disable">Log In</button>

                </div>
                
            </form>
        </div>
    </div>
    <script>

let signupbtn =document.getElementById("signupbtn")
let signinbtn =document.getElementById("signinbtn")
let namefield =document.getElementById("namefield")
let title =document.getElementById("title")

signinbtn.onclick =function(){
    namefield.style.maxHeight ="0";
    phonefield.style.maxHeight ="0";
    title.innerHTML = "Log In";
    signupbtn.classList.add("disable");
    signinbtn.classList.remove("disable");  
}
signupbtn.onclick =function(){
    namefield.style.maxHeight ="60px";
    phonefield.style.maxHeight ="60px";
    title.innerHTML = "Sign Up";
    signupbtn.classList.remove("disable");
    signinbtn.classList.add("disable");

}

</script>
</body>
</html>