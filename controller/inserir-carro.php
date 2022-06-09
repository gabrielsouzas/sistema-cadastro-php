<?php
    // Inclui a conexão com o Banco
    include_once "../controller/conexao.php";

    // Recebe os dados do Javascript
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Valida o formulário
    /*if (empty($dados['codigo'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo código!</div>"];
    } else*/if (empty($dados['marca'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo marca!</div>"];
    } elseif (empty($dados['cor'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo cor!</div>"];
    } elseif (empty($dados['aro'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo aro!</div>"];
    } elseif (empty($dados['conversivel'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo conversível!</div>"];
    } elseif (empty($dados['placa'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo placa!</div>"];
    } elseif (empty($dados['tipo'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo tipo!</div>"];
    } elseif (empty($dados['preco'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo preço!</div>"];
    } elseif (empty($dados['motor'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo motor!</div>"];
    } elseif (empty($dados['velocidademax'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo velocidade máxima!</div>"];
    } else {
        // Cadastrar no BD
        $query = "INSERT INTO carro(
            carro_marca, carro_cor, carro_aro, carro_conversivel, 
            carro_placa, carro_tipo, carro_preco, carro_motor, carro_velocidademax)
          VALUES (:carro_marca, :carro_cor, :carro_aro, :carro_conversivel, 
            :carro_placa, :carro_tipo, :carro_preco, :carro_motor, :carro_velocidademax);";
        
        $cad_carro_stm = $connpdo->prepare($query);

        //$cad_carro_stm->bindParam(':carro_codigo', $dados['codigo']);
        $cad_carro_stm->bindParam(':carro_marca', $dados['marca']);
        $cad_carro_stm->bindParam(':carro_cor', $dados['cor']);
        $cad_carro_stm->bindParam(':carro_aro', $dados['aro']);
        $cad_carro_stm->bindParam(':carro_conversivel', $dados['conversivel']);
        $cad_carro_stm->bindParam(':carro_placa', $dados['placa']);
        $cad_carro_stm->bindParam(':carro_tipo', $dados['tipo']);
        $cad_carro_stm->bindParam(':carro_preco', $dados['preco']);
        $cad_carro_stm->bindParam(':carro_motor', $dados['motor']);
        $cad_carro_stm->bindParam(':carro_velocidademax', $dados['velocidademax']);

        $cad_carro_stm->execute();

        //Recuperar o ultimo id inserido caso insira alguma chave estrangeira
        //$id_carro = $connpdo->lastInsertId();

        // Verificar se cadastrou corretamente
        if ($cad_carro_stm->rowCount()) {
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>
            Carro cadastrado com Sucesso!
          </div>"];
        } else {
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
            Erro: Carro não cadastrado!
          </div>"];
        }
        
    }

    echo json_encode($retorna)
    
?>