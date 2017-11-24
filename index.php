<?php
   $db =  mysqli_connect("localhost" , "root" , "" , "blogs"); 
   session_start();

   $user_check = $_SESSION["login_user"];

   $ses_sql = mysqli_query($db, "SELECT username FROM users WHERE username = '$user_check'");
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
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css"/>

</head>

<body>

<h1>Welcome <?php echo $login_session; ?></h1> 
<!-- Button trigger modal -->
<button class="btn btn-info btn-block" style="width:100%;" data-toggle="modal" data-target="#myModal">Crear Post</button>


<!-- Modal --><br>
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
    
    <form action="insert_post.php" method="post">
    <div class="form-group">
        <br>
      <label for="exampleInputEmail1">Usuario</label>
      <input type="text" class="form-control" id="exampleInputEmail1" name="usuario"  placeholder="Enter username">
      <small id="emailHelp" class="form-text text-muted">Aún no hago las sesiones</small>
    </div>
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
if(!$conn){ echo "no hay conexion";}
$posts = "SELECT * FROM post";
$result_post = $conn->query($posts);
//$result_comments = $conn->query($comentarios);
   if($result_post->num_rows > 0){
    while($row = $result_post->fetch_assoc()){
echo "
<div class=\"detailBox\">
    <div class=\"titleBox\">
      <label>" .  $row["tema"]  . "</label>
        <button type=\"button\" class=\"close\" aria-hidden=\"true\">&times;</button>
    </div>
    <div class=\"commentBox\">

    <div class=\"commenterImage\">
       <img src=\"http://placekitten.com/45/45\" />
     </div>
        <p class=\"taskDescription\">" . $row["contenido"] . " </p>
        <span class=\"date sub-text\">" . $row["usuario"] . " </b></span>
    </div>
    <div class=\"actionBox\">
        <ul class=\"commentList\">";
        $comentarios = "SELECT * FROM comments WHERE post_id = $row[id]";
        $result_comments = $conn->query($comentarios);
        while($row2 = $result_comments->fetch_assoc()){
        echo "
            <li>
                <div class=\"commenterImage\">
                  <img src=\"http://placekitten.com/45/45\" />
                </div>
                <div class=\"commentText\">
                    <p class=\"\">" . $row2["contenido"] . "</p> <span class=\"date sub-text\">" . $row2["dia"] . " <b> ".  $row2["usuario_comentario"] . " </b></span>
                </div>
            </li>"
            ;
        }
    echo "
        </ul>
        <form class=\"form-inline\" role=\"form\">
            <div class=\"form-group\">
                <input class=\"form-control\" type=\"text\" placeholder=\"Your comments\" />
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
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>