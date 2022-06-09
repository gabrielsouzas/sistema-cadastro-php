<?php 

// Inclui a conexão com o Banco
include_once "../controller/conexao.php";

// Paginação em PHP e Javascript (recebe um parametro numerico pagina atraves do get)
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {
    
    // Calcular o inicio da visualização
    $qnt_result_pg = 10; // Quantidade de registro por página
    $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    // Consulta para recuperar os registros do Banco de dados
    $query = "SELECT carro_codigo, carro_marca, carro_cor, carro_aro, carro_conversivel, 
            carro_placa, carro_tipo, carro_preco, carro_motor, carro_velocidademax
    FROM carro
    ORDER BY carro_codigo DESC LIMIT $qnt_result_pg OFFSET $inicio;"; 

    $result_carros = $connpdo->prepare($query);
    $result_carros->execute();

    //Verifica o retorno do banco
    if (($result_carros) and ($result_carros->rowCount() != 0)) {
        $dados = "<div class='table-responsive'>";
        $dados .= "<table class='table table-secondary table-striped table-sm table-hover'>";
        // .= concatenar strings em PHP
        $dados .= "<thead>";
        $dados .= "<tr>";

        $dados .= "<th scope='col'>Código</th>";
        $dados .= "<th scope='col'>Marca</th>";
        $dados .= "<th scope='col'>Cor</th>";
        $dados .= "<th scope='col'>Aro</th>";
        $dados .= "<th scope='col'>Conversivel</th>";
        $dados .= "<th scope='col'>Placa</th>";
        $dados .= "<th scope='col'>Tipo</th>";
        $dados .= "<th scope='col'>Preço</th>";
        $dados .= "<th scope='col'>Motor</th>";
        $dados .= "<th scope='col'>Velocidade Max.</th>";
        $dados .= "<th scope='col'>Visualizar</th>";

        $dados .= "</tr>";
        $dados .= "</thead>";
        $dados .= "<tbody>";
        // Loop para pegar os registros do banco
        // Vai ler o que esta dentro de $result_carros
        // Para ler utiliza o fetch
        // Para resolução de escopo PDO:: (para a conexão que é em PDO)
        // FETCH_ASSOC para imprimir pelo nome da coluna
        while($linha = $result_carros->fetch(PDO::FETCH_ASSOC)){
            // Cria variaveis dos campos da tabela
            extract($linha);
            $dados .= "<tr>";

            $dados .= "<td>$carro_codigo</td>";
            $dados .= "<td>$carro_marca</td>";
            $dados .= "<td>$carro_cor</td>";
            $dados .= "<td>$carro_aro</td>";
            $dados .= "<td>$carro_conversivel</td>";
            $dados .= "<td>$carro_placa</td>";
            $dados .= "<td>$carro_tipo</td>";
            $dados .= "<td>$carro_preco</td>";
            $dados .= "<td>$carro_motor</td>";
            $dados .= "<td>$carro_velocidademax</td>";
            $dados .= "<td>";
            $dados .= "<div class='d-grid gap-30 d-md-block'>";
            $dados .= "<a id='btn-visualizar' href='#' class='btn btn-outline-primary btn-sm' onclick='visCarro($carro_codigo)'>Visualizar</a>";
            $dados .= "<a id='btn-editar' href='#' class='btn btn-outline-warning btn-sm' id='btneditar' onclick='editCarro($carro_codigo)'>Editar</a>";
            $dados .= "<a id='btn-apagar' href='#' class='btn btn-outline-danger btn-sm' id='btnapagar' onclick='apagCarro($carro_codigo)'>Apagar</a>";
            $dados .= "</div>";
            $dados .= "</td>";

            $dados .= "</tr>";
        }
        $dados .= "</tbody>";
        $dados .= "</table>";
        $dados .= "</div>";

        // Paginação = Contando a quantidade de linhas
        $query_pg = "SELECT COUNT(carro_codigo) AS num_result FROM carro;";
        $result_pg = $connpdo->prepare($query_pg);
        $result_pg->execute();
        $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

        //Quantidade de páginas
        // Pega a qtde de linhas atraves do alias num_result
        $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

        // Quantidade de links de páginas na tela
        $max_links = 2;

        $dados .= "<nav aria-label='Page navigation example'>";
        $dados .= "<ul class='pagination justify-content-center'>";

        // Primeira página
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCarros(1)'>Primeira</a></li>";

        // Botão Anterior
        $ant_pag = $pagina;
        if (($pagina - 1) >= 1) {
          $ant_pag = $pagina - 1;
        }
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCarros($ant_pag)'>Anterior</a></li>";
        
        // Imprime os links baseado na $max_links (Botões numerados anteriores)
        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) { 
          if ($pag_ant >= 1) {
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCarros($pag_ant)'>$pag_ant</a></li>";
          }
        }

        $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

        // Imprime os links baseado na $max_links (Botões numerados posteriores)
        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) { 
          if ($pag_dep <= $quantidade_pg) {
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCarros($pag_dep)'>$pag_dep</a></li>";
          }
        }

        // Botão Próximo
        $prox_pag = $pagina;
        if (($pagina + 1) <= $quantidade_pg) {
          $prox_pag = $pagina + 1;
        }
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCarros($prox_pag)' >Próxima</a></li>";

        // Última página
        $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarCarros($quantidade_pg)'>Última</a></li>";
        $dados .= "</ul>";
        $dados .= "</nav>";
        
        $retorna = ['status' => true, 'dados' => $dados];
    } else {
        $retorna = ['status' => false, 'msg' => "<p style='color:'#f00'>Erro: Nenhum carro encontrado!</p>"];
    }

    // Converte a mensagem para Objeto e retorna para o Javascript
    echo json_encode($retorna);

} else {
    echo "<div class='alert alert-danger' role='alert'>
    Nenhum carro encontrado!
  </div>";
}

?>