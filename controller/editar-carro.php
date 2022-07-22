<?php
    
    // Arquivo com o método de cadastrar insert
    include_once "../controller/simply-contr-methods.php";

    // Recebe os dados do Javascript
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Tabela que vai ser feita a inserção
    $tabela = "carro";

    // Método para editar
    // ATENÇÂO: Os nomes dos inputs devem ser iguais aos nomes dos campos no banco de dados
    echo edit($dados, $tabela);

    // Valida o formulário
    /*if (empty($dados['codigo'])) {
        $retorna = ['status' => false, 'msg' => "<div> class='alert alert-danger role='alert'>Erro: Necessário preencher o campo código!</div>"];
    } elseif (empty($dados['marca'])) {
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
        // Editar no BD
        $query = "UPDATE carro
                  SET carro_marca=:carro_marca, carro_cor=:carro_cor, carro_aro=:carro_aro, carro_conversivel=:carro_conversivel, 
                      carro_placa=:carro_placa, carro_tipo=:carro_tipo, carro_preco=:carro_preco, carro_motor=:carro_motor, carro_velocidademax=:carro_velocidademax
                  WHERE carro_codigo = :carro_codigo;";
        
        $edit_carro_stm = $connpdo->prepare($query);

        $edit_carro_stm->bindParam(':carro_codigo', $dados['codigo']);
        $edit_carro_stm->bindParam(':carro_marca', $dados['marca']);
        $edit_carro_stm->bindParam(':carro_cor', $dados['cor']);
        $edit_carro_stm->bindParam(':carro_aro', $dados['aro']);
        $edit_carro_stm->bindParam(':carro_conversivel', $dados['conversivel']);
        $edit_carro_stm->bindParam(':carro_placa', $dados['placa']);
        $edit_carro_stm->bindParam(':carro_tipo', $dados['tipo']);
        $edit_carro_stm->bindParam(':carro_preco', $dados['preco']);
        $edit_carro_stm->bindParam(':carro_motor', $dados['motor']);
        $edit_carro_stm->bindParam(':carro_velocidademax', $dados['velocidademax']);

        // Verificar se editou corretamente
        if ($edit_carro_stm->execute()) {
            $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>
            Carro editado com Sucesso!
          </div>"];
        } else {
            $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>
            Erro: Carro não editado!
          </div>"];
        }
        
    }

    echo json_encode($retorna)
    */
    
?>