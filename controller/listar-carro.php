<?php
    include_once "../controller/simply-contr-methods.php";

    // Paginação em PHP e Javascript (recebe um parametro numerico pagina atraves do get)
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

    // Atributos que vão ser passados para a buscar a lista
    
    // Nome da tabela
    $tabela = "carro";
    // Nome da coluna com o código da tabela e que vai definir a ordem da lista
    $coluna_codigo = "carro_codigo";
    // Quantidade de linhas por página
    $qtde_linhas_pagina = 5;
    // Colunas da tabela
    $colunas = [
        "Código",
        "Marca",
        "Cor",
        "Aro",
        "Conversível",
        "Placa",
        "Tipo",
        "Preço",
        "Motor",
        "Vel. Maxima",
    ];

    // Método que vai buscar os dados na tabela e retornar um json
    echo returnList($tabela, $coluna_codigo, $colunas, $pagina, $qtde_linhas_pagina);

?>