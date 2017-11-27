<?php
     $conn =  mysqli_connect("localhost" , "root" , "" , "blogs"); 

        $sql = "INSERT INTO users (name, last_name, phone, age, username, mail, password, img)
        VALUES (
        '{$conn->real_escape_string($_POST['name'])}', 
        '{$conn->real_escape_string($_POST['last_name'])}',
        '{$conn->real_escape_string($_POST['phone'])}', 
        '{$conn->real_escape_string($_POST['age'])}',
        '{$conn->real_escape_string($_POST['username'])}', 
        '{$conn->real_escape_string($_POST['mail'])}',
        '{$conn->real_escape_string($_POST['password'])}', 
        '{$conn->real_escape_string($_POST['img'])}'
        )";
    $insert = $conn->query($sql); 
    if ($insert) 
    { 
        echo "<script> alert('New User Created'); </script>";
    }
    else 
    { 
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: login.php");
?>