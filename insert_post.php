<?php
     $conn =  mysqli_connect("localhost" , "root" , "" , "blogs"); 
     session_start();
     $user_check = $_SESSION["login_user"];
     $ses_sql = mysqli_query($conn, "SELECT id, name, last_name, phone, age, username, mail
     FROM users WHERE username = '$user_check'");
     $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
     $login_session = $row['username'];
     
    if($_POST['tema'] == "" || $_POST['contenido'] == "")
    {
        echo "<script> alert('¡No puedes dejar la informacion en blanco!'); </script>";
    }
    else
    {
        $sql = "INSERT INTO post (usuario, tema, contenido)
        VALUES ('$login_session',
        '{$conn->real_escape_string($_POST['tema'])}', 
        '{$conn->real_escape_string($_POST['contenido'])}')";
    }
    $insert = $conn->query($sql); 
    if ($insert) 
    { 
        echo "N<script> alert('New Post Created'); </script>";
    }
    else 
    { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
?>