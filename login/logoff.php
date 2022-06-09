<?php 
    if (!$_SESSION) {
        session_start();
    }

    // Destroi a sessão
    session_destroy();

    // Redireciona para a tela de login
    header("Location: ../main/login.php");
?>