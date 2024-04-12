<?php

session_start();

if ($_POST['username'] == 'arthur' && $_POST['password'] == 'senha') {

    $_SESSION['username'] = $_POST['username'];

    header("Location: content.php");

    exit();
    
} else {
    echo "<script>alert('Usuário ou senha incorretos.'); window.location='login.php';</script>";
}
?>
