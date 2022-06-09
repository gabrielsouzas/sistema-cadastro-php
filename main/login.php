<?php
    include('../controller/conexao.php');

    if (isset($_POST['usuario']) || isset($_POST['senha'])) {
        if (strlen($_POST['usuario']) == 0) {
            echo "Preencha o usuário!";
        } else if (strlen($_POST['senha']) == 0){
            echo "Preencha sua senha!";
        } else {
            // Limpa as strings que o usuario digitou para que não seja feita uma tentativa de sql injection por uma pessoa mal intensionada
            $usuario = pg_escape_string($_POST['usuario']);
            $senha = pg_escape_string($_POST['senha']);

            $query = "SELECT * FROM login WHERE usuario LIKE '$usuario' AND senha LIKE '$senha';";
            $query = $connpdo->query($query) or die("Falha na execução do código SQL." . $connpdo->error);
            
            // Pega a quantidade de registros buscados
            $qtde = $query->rowCount();//pg_num_rows($query);
            // Se retornar um registro é porque o usuario existe e a senha está correta
            if ($qtde == 1) {
                // Pega os dados retornados da query e joga na variavel usuario
                $usuario = $query->fetch(PDO::FETCH_ASSOC);

                // Se não existir sessão inicia uma
                if (!isset($_SESSION)) {
                    session_start();
                }

                // Seta a sessão para o usuario logado
                $_SESSION['codigo'] = $usuario['codigo'];
                $_SESSION['usuario'] = $usuario['usuario'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: ../main/index.php");

            } else {
                echo "Falha ao logar! Usuário ou senha incorretos.";
            }
        }
        
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-login.css">
    <title>Login - Sistema de Venda de Carros</title>
</head>
<body>
    <div class="main-login">
        <div class="left-login">
            <h1>Sistema de Venda de Carros</h1>
            <img class="left-login-image" src="../image/venda-carros.svg" alt="Venda de Carros Animação">
        </div>
        <form action="" method="POST">
            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>
                        <span class="login-error"></span>
                        <div class="textfield">
                            <label for="usuario">Usuário</label>
                            <input type="text" name="usuario" id="txtusuario" placeholder="Usuário" required>
                        </div>
                        <div class="textfield">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" id="pswsenha" placeholder="Senha" required>
                        </div>
                        <button class="btn-login" type="submit">Login</button>
            
                </div>
            </div>
        </form>
    </div>
</body>
</html>