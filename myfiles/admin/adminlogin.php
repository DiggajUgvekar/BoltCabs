<?php
require("connection.php");
?>
<html>
    <head>
        <title>Admin login</title>
        <meta charset="utf-8" name="viewport" content="">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15,1/css/all.css">
        <link rel="stylesheet" type="text/css" href="../style/mycss.css">

    </head>
    <body>
        <div class="login-form">
            <h2>ADMIN LOGIN</h2>
            <form method="post">
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Admin Email " name="Adminname">
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="password" name="Adminpassword">
                </div>

                <button type="submit" name="Signin">Sign In</button>

            </form>
        </div>

        <?php
if (isset($_POST['Signin'])) {

    $query = "SELECT admin_password FROM `admin_login` WHERE `admin_name`=?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $_POST['Adminname']);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($_POST['Adminpassword'], $row['admin_password'])) {
            session_start();
            $_SESSION['AdminloginId'] = $_POST['Adminname'];
            header("location: adminpanel.php");
        } else {
            echo "<script>alert('Incorrect Password');</script>";
        }
    } else {
        echo "<script>alert('Username not found');</script>";
    }
}

?>

    </body>
</html>