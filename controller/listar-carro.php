<?php
    include_once "../controller/simply-contr-methods.php";

    // Paginação em PHP e Javascript (recebe um parametro numerico pagina atraves do get)
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

    $colunas = [
        "carro_codigo",
        "carro_marca",
        "carro_cor",
        "carro_aro",
        "carro_conversivel",
        "carro_placa",
        "carro_tipo",
        "carro_preco",
        "carro_motor",
        "carro_velocidademax",
    ];
    echo returnList("carro", "carro_codigo", $colunas, $pagina);

?>