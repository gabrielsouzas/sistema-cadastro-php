<?php

    // Arquivo com o método de cadastrar insert
    include_once "../controller/simply-contr-methods.php";

    // Recebe os dados do Javascript
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Tabela que vai ser feita a inserção
    $tabela = "carro";

    // Método para cadastrar
    // ATENÇÂO: Os nomes dos inputs devem ser iguais aos nomes dos campos no banco de dados
    echo insert($dados, $tabela)

?>