<?php
    // Arquivo com o método de visualizar
    include_once "../controller/simply-contr-methods.php";

    // Recebe o código do Javascript que veio do index.php
    $cod = filter_input(INPUT_GET, "codigo", FILTER_SANITIZE_NUMBER_INT);

    $tabela = "carro";

    $col_id = "carro_codigo";

    echo delete($cod, $tabela, $col_id);

    /*
    // Se a variavel código for diferente de vazia prossegue
    if (!empty($cod)) {
        // Aqui poderia ser passado diretamente, mas por questão de segurança é recomendado utilizar link
        $query = "DELETE FROM carro WHERE carro_codigo=:carro_codigo;";
        // Cria a query
        $del_carro = $connpdo->prepare($query);
        
        $del_carro->bindParam(':carro_codigo', $cod);

        if ($del_carro->execute()) {
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>
            Carro apagado com Sucesso!
          </div>"];

        } else {
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
            Carro não apagado!
          </div>"];
        }

    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
            Carro não encontrado!
          </div>"];
    }

    echo json_encode($retorna)*/
    
?>