<?php 

    /* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
    simplesmente não fazer o login e digitar na barra de endereço do seu navegador
    o caminho para a página principal do site (sistema), burlando assim a obrigação de
    fazer um login, com isso se ele não estiver feito o login não será criado a session*/

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['codigo'])) {
        die("Você não pode acessar essa página porque não está logado.<p><a href=\"login.php\">Entrar</a></p>");
    }

?>