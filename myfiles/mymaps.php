<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <link rel="stylesheet" href="./style/login.css">
  <script src="https://kit.fontawesome.com/df94d1352d.js" crossorigin="anonymous"></script>
  <style>
    #googleMap{
            width:80%;
            height: 400px;
            margin: 20px auto;
            box-shadow: 0px 0px 1000px black;
            border:20px;
          }
          .container-fluid{
            margin:120px;
          }
    div .padding1{
      padding-top:15px;
      padding-bottom:15px;
    }
    div .padding1 i{
      padding-right:15px;
    }
    .btn-field i{
      width: 100px
    }
    .container{
      background-image:url();
    }
    .maincontainer{
      height: 200vb;
      background-image:url(img/route2.jpg);
      background-size: cover;
    }
    </style>
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
    
    <div class="maincontainer">
    <div class="container">
        <div class="formbox">
            <h1 id="title">Select You Route</h1>
            <form >
              <div class="input-group">
                    <div class="input-field">
                    <label for="from" class="content-label" ><i class="fa-regular fa-circle-dot"></i></label>
                   <input type="text" id="from"placeholder="Pick Up Location" class="origin">
              </div>

              <div class="input-field padding1">
              <i class="fa-regular fa-calendar"></i>
                   <select name="district" id="district" class="district" >
                      <option value="northgoa">North Goa</option>
                      <option value="southgoa">South Goa</option>
                    </select>
                  </div>

                  <div class="input-field">
                  <i class="fa-regular fa-calendar"></i>
                            <input type="datetime-local" id="arrivaltime" name="arrivaltime"><br>
                  </div>
                  <div class="input-field">
                            <label for="to" class="content-label" ><i class="fa-solid fa-location-dot"></i></label>
                            <input type="text" id="to" placeholder="Destination Location" class="destination"><br>

                                      </div>
                  </div>
                                  <div class="btn-field">
                                      <button type="submit" id="direction"><i class="fa-solid fa-diamond-turn-right"></i></button>

                                  </div>
                                  
            </form>
          </div>
          
        </div>
        <div class="container-fluid">
            <div id="googleMap">
    
            </div>
            <div id="output">
    
            </div>
        </div>
        </div>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqKus73FNOpTej_8X2WdkAKzKFXajUIyI&libraries=places"></script>

    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqKus73FNOpTej_8X2WdkAKzKFXajUIyI&libra"></script> -->
    <script src="script.js"></script>
</body>
</html>

<!-- 

<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/formstyle.css">
    <script src="https://kit.fontawesome.com/df94d1352d.js" crossorigin="anonymous"></script>
    <style>
          #googleMap{
            width:80%;
            height: 400px;
            margin: 20px auto;
          }
          .container-fluid{
            margin:120px;
          }
        </style>
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
    
    <div class="container">
      <div class="container-fluid">
        <h1>Select you Route</h1>
        <form class="formbooking" method="post">
          <label for="from" class="content-label" ><i class="fa-regular fa-circle-dot"></i></label>
          <input type="text" placeholder="Pick Up Location" class="origin"> <br>
          
          <label for="district">District:</label>
          <select name="district" id="district">
            <option value="northgoa">North Goa</option>
            <option value="southgoa">South Goa</option>
          </select>
          <br>

          <label for="arrivaltime">Date and Time :</label>
          <input type="datetime-local" id="arrivaltime" name="arrivaltime"><br>

          <label for="to" class="content-label" ><i class="fa-solid fa-location-dot"></i></label>
          <input type="text" placeholder="Destination Location" class="destination"><br>


          <button class="btn"><i class="fa-solid fa-diamond-turn-right"></i></button>
        </form>
      </div>
    </div>
    <div class="container-fluid">
        <div id="googleMap">

        </div>
        <div id="output">

        </div>
    </div>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqKus73FNOpTej_8X2WdkAKzKFXajUIyI"></script>
    <script src="script.js"></script>
</body>
</html> -->