<?php

$db =  mysqli_connect("localhost" , "root" , "" , "blogs"); 
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);
    $sql = "SELECT id FROM users WHERE (username = '$myusername' OR mail = '$myusername')
    AND password  = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result,  MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1)
    {
        $_SESSION['login_user'] = $myusername;
        header("location: index.php");
    }
    else
    {
        $error = "Username or password Incorrect";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style_login.css" />
</head>

<body>


    <div class="container">
        <div class="card card-container">
            <img class="profile-img-card" src="https://www.shareicon.net/download/2015/08/15/85434_guest_512x512.png" alt="" />
            <!-- <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />-->
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                            <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form>
            <!-- /form -->
            <a href="#" class="forgot-password"> Forgot the password? </a>
            <a href="#" class="forgot-password"> Sign In</a>
        </div>
        <!-- /card-container -->
    </div>
    <!-- /container -->

    <script src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>
