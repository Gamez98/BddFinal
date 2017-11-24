<?php
    $conn = new mysqli("localhost", "root", "", "blogs");
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 

    
    if($_POST['usuario'] == "" || $_POST['tema'] == "" || $_POST['contenido'] == "")
    {
        echo "<script> alert('¡No puedes dejar la informacion en blanco!'); </script>";
    }
    else
    {
        $sql = "INSERT INTO post (usuario, tema, contenido)
        VALUES ('{$conn->real_escape_string($_POST['usuario'])}',
        '{$conn->real_escape_string($_POST['tema'])}', 
        '{$conn->real_escape_string($_POST['contenido'])}')";
    }

$insert = $conn->query($sql); 

if ($insert) { echo "New record created successfully";}
else { echo "Error: " . $sql . "<br>" . $conn->error;}

$conn->close();
header("Location: index.php");
?>