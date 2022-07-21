<?php

    // Arquivo com o método de cadastrar insert
    include_once "../controller/simply-contr-methods.php";

    // Recebe os dados do Javascript
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $campos_banco = [
        "carro_codigo" => "carro_codigo",
        "carro_marca" =>"carro_marca",
        "carro_cor" =>"carro_cor",
        "carro_aro" =>"carro_aro",
        "carro_conversivel" =>"carro_conversivel",
        "carro_placa" =>"carro_placa",
        "carro_tipo" =>"carro_tipo",
        "carro_preco" =>"carro_preco",
        "carro_motor" =>"carro_motor",
        "carro_velocidademax" =>"carro_velocidademax"
    ];

    // Insira um valor aqui caso o id/código seja serial
    $id_ignorar = "carro_codigo";

    echo insert($dados, "carro", $campos_banco, $id_ignorar)

?>