<?php
$db =  mysqli_connect("localhost" , "root" , "" , "blogs"); 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);
    $sql = "SELECT id FROM users WHERE (username = '$myusername' OR mail = '$myusername')
    AND password  = '$mypassword'";

    //Sql image
    $img_sql = "SELECT img FROM users WHERE username = '$myusername'";

    $result = mysqli_query($db, $sql);

    //Sql imge 
    $img_result = mysqli_query($db, $img_sql);

    $row = mysqli_fetch_array($result,  MYSQLI_ASSOC);

    //Sql image 
    $row2 = mysqli_fetch_array($img_result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if($count == 1)
    {
        $_SESSION['login_user'] = $myusername;
        header("location: index.php");
    }
    else
    {
        echo "<script>alert(\"Usuario o contraseña incorrecta\");</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style_login.css" />
</head>

<body>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New User</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
        </div>
        <div class="modal-body">
            <form action="insert_user.php" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name"  placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">Last Name</label>
                <input type="text" class="form-control" id="exampleInputEmail2" name="last_name"  placeholder="Enter Lastname" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail3">Phone</label>
                <input type="text" class="form-control" id="exampleInputEmail3" name="phone"  placeholder="Enter Phone" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail4">Age</label>
                <input type="text" class="form-control" id="exampleInputEmail4" name="age"  placeholder="Enter Age" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail5">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail5" name="username"  placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail6">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail6" name="mail"  placeholder="Enter Email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail7">Password</label>
                <input type="password" class="form-control" id="exampleInputEmail7" name="password"  placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail8">Picture URL</label>
                <input type="text" class="form-control" id="exampleInputEmail8" name="img"  placeholder="Enter Url" required>
            </div>
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
            </form>
             </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

    <div class="container">
        <div class="card card-container">
            <img class="profile-img-card" src="<?php echo $row2['img']; ?>" alt="" />
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
            <a href="#" class="forgot-password"> Forgot the password? </a>
            <a href="#" class="forgot-password" data-toggle="modal" data-target="#myModal">Sign In</a>
        </div>
    </div>
    
    <script src="js/index.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>

</html>
