<?php
    // Arquivo com o método de visualizar
    include_once "../controller/simply-contr-methods.php";

    // Recebe os dados do Javascript
    $codigo = filter_input(INPUT_GET, 'codigo', FILTER_SANITIZE_NUMBER_INT);
    
    $tabela = "carro";

    $col_id = "carro_codigo";

    echo visualize($codigo, $tabela, $col_id);
    
    /*
    // Acessa o IF quando a variável CODIGO possuir valor
    if (!empty($codigo)) {
        
        $query = "SELECT carro_codigo, carro_marca, carro_cor, carro_aro, carro_conversivel, 
                         carro_placa, carro_tipo, carro_preco, carro_motor, carro_velocidademax
                  FROM carro WHERE carro_codigo = :codigo;";

        $carro_retornado = $connpdo->prepare($query);
        $carro_retornado->bindParam(':codigo', $codigo);
        $carro_retornado->execute();

        if(($carro_retornado) and ($carro_retornado->rowCount() != 0)){
            $row_carro = $carro_retornado->fetch(PDO::FETCH_ASSOC);
            $retorna = ['status' => true, 'dados' => $row_carro];
        } else {
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
        Erro: Nenhum carro encontrado!
      </div>"];
        }


    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
        Erro: Nenhum carro encontrado!
      </div>"];
    }

    echo json_encode($retorna)*/
    
?>