<?php
    $conn =  mysqli_connect("localhost" , "root" , "" , "blogs"); 
    session_start();
    $user_check = $_SESSION["login_user"];
    $ses_sql = mysqli_query($conn, "SELECT id, name, last_name, phone, age, username, mail
    FROM users WHERE username = '$user_check'");
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
    $login_session = $row['username'];
    $oDate = new DateTime($row->createdate);
    $sDate = $oDate->format("Y-m-d H:i:s");
    if($_GET['comment'] == "")
    { 
        echo "<script> alert('¡No puedes dejar la informacion en blanco!'); </script>";
    }
    {
        $sql = "INSERT INTO comments (post_id, dia, contenido, usuario_comentario)
        VALUES ('{$conn->real_escape_string($_GET['id'])}', '$sDate' , '{$conn->real_escape_string($_GET['comment'])}', '$login_session')";
    }  
    $insert = $conn->query($sql);     
    if ($insert) 
    { 
        echo "New record created successfully";
    }
    else 
    { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
?>