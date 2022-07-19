<?php
    include_once "../controller/simply-contr-methods.php";

    // Paginação em PHP e Javascript (recebe um parametro numerico pagina atraves do get)
    $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

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
    echo returnList("carro", "carro_codigo", $colunas, $pagina, 5);

?>