<?php
   $db =  mysqli_connect("localhost" , "root" , "" , "blogs"); 
   session_start();
   $user_check = $_SESSION["login_user"];
   $ses_sql = mysqli_query($db, "SELECT id, name, last_name, phone, age, username, mail, img
   FROM users WHERE username = '$user_check'");
   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   $login_session = $row['username'];
   if(!isset($_SESSION['login_user']))
   {
       header("location: login.php");
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido <?php echo $row["name"]; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="./css/style.css"/>
</head>

<body>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="#">
    <img src=" <?php echo $row['img']; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
   <?php echo $login_session; ?>
</a>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#myModal">Create Post<span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="text" placeholder="Search User">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  <form class="form-inline my-2 my-lg-0" action="close_session.php" method="POST">
    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
  </form> 
</div>
</nav>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Nuevo Post</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
    <form action="insert_post.php" method="POST">
    <div class="form-group">
      <label for="exampleInputEmail1">Tema</label>
      <input type="text" class="form-control" id="exampleInputEmail1" name="tema"  placeholder="Enter Topic">
      <small id="emailHelp" class="form-text text-muted">Publica algo interesante.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Contenido</label>
      <textarea type="text" class="form-control" id="exampleInputPassword1" name="contenido" placeholder="Content"></textarea>
    </div>
    <button type="submit" class="btn btn-info btn-block">Publicar</button>
  </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<?php 
$conn = new mysqli("localhost", "root", "", "blogs");
   if(!$conn)
   { 
        echo "<script> alert(\"Error de base de datos\"); </script>";
   }
$posts = "SELECT * FROM post ;";
$result_post = $conn->query($posts);
//$result_comments = $conn->query($comentarios);
   if($result_post->num_rows > 0){
    while($row = $result_post->fetch_assoc()){
echo "
<div class=\"detailBox\">
    <div class=\"titleBox\">
      <label>" .  $row["tema"]  . "</label>
         <button type=\"input\" class=\"close\" aria-hidden=\"true\">&times;</button>
    </div>
    <div class=\"commentBox\">
    <div class=\"commenterImage\">
       <img src=\"\" />
    </div>
        <p class=\"taskDescription\">" . $row["contenido"] . " </p>
        <span class=\"date sub-text\">" . $row["usuario"] . " </b></span>
    </div>
    <div class=\"actionBox\">
        <ul class=\"commentList\">";
        //$comentarios = "SELECT * FROM comments WHERE post_id = $row[id]";
        $comentarios = "SELECT * FROM comments WHERE post_id = $row[id]";
        $result_comments = $conn->query($comentarios);
        while($row2 = $result_comments->fetch_assoc()){
        echo "
            <li>
                <div class=\"commenterImage\">
                  <img src=\"\" />
                </div>
                <div class=\"commentText\">
                    <p class=\"\">" . $row2["contenido"] . "</p> <span class=\"date sub-text\">" . $row2["dia"] . " <b> ".  $row2["usuario_comentario"] . " </b></span>
                </div>
            </li>"
            ;
        }
    echo "
        </ul>
        <form class=\"form-inline\" role=\"form\" method=\"GET\" action=\"insert_comment.php\">
            <div class=\"form-group\">
                <input class=\"form-control\" type=\"hidden\" name=\"id\"  id=\"id\" value='".$row['id']."' />  
                <input class=\"form-control\" type=\"text\" placeholder=\"Your comments\" name=\"comment\" id=\"comment\"/>   
            </div>
            <div class=\"form-group\">
                <button class=\"btn btn-default\">Add</button>
            </div>
        </form>
    </div>
</div>";
    }
}
?>

<script>
$("#myModal").click(function(){
    $.ajax({
        url: "index.php",
        type: "GET",
        success: function(){
            alert("Hola mundo");
        }
    });
});

$("#comment").click(function(){
    $.ajax({
        url: "index.php",
        type: "GET",
        success: function(){
            alert("Hola mundo");
        }
    });
});
</script>
</body>
</html>