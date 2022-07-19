<?php 

    function returnList($table, $order, $columns, $pagina){
    
        // Inclui a conexão com o Banco
        include_once "../controller/conexao.php";

        if (!empty($pagina)) {
            
            // Calcular o inicio da visualização
            $qnt_result_pg = 10; // Quantidade de registro por página
            $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

            // Consulta para recuperar os registros do Banco de dados
            $query = "SELECT * FROM $table ORDER BY $order DESC LIMIT $qnt_result_pg OFFSET $inicio;"; 

            $result = $connpdo->prepare($query);
            $result->execute();

            //Verifica o retorno do banco
            if (($result) and ($result->rowCount() != 0)) {
                $dados = "<div class='table-responsive'>";
                // .= concatenar strings em PHP
                $dados .= "<table class='table table-secondary table-striped table-sm table-hover'>";
                $dados .= "<thead>";
                $dados .= "<tr>";

                // Adiciona os titulos das colunas
                foreach ($columns as $col) {
                    $dados .= "<th scope='col'>$col</th>";
                }

                $dados .= "<th scope='col'>Manutenção</th>";

                $dados .= "</tr>";
                $dados .= "</thead>";
                $dados .= "<tbody>";
                // Loop para pegar os registros do banco
                // Vai ler o que esta dentro de $result
                // Para ler utiliza o fetch
                // Para resolução de escopo PDO:: (para a conexão que é em PDO)
                // FETCH_ASSOC para imprimir pelo nome da coluna
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                    // Cria variaveis dos campos da tabela
                    extract($linha);
                    $dados .= "<tr>";

                    foreach ($linha as $value) {
                        $dados .= "<td>$value</td>";
                    }
                    
                    $cod = current($linha);
                    

                    $dados .= "<td>";
                    $dados .= "<div class='d-grid gap-30 d-md-block'>";
                    $dados .= "<a id='btn-visualizar' href='#' class='btn btn-outline-primary btn-sm' onclick='visCarro($cod)'>Visualizar</a>";
                    $dados .= "<a id='btn-editar' href='#' class='btn btn-outline-warning btn-sm' id='btneditar' onclick='editCarro($cod)'>Editar</a>";
                    $dados .= "<a id='btn-apagar' href='#' class='btn btn-outline-danger btn-sm' id='btnapagar' onclick='apagCarro($cod)'>Apagar</a>";
                    $dados .= "</div>";
                    $dados .= "</td>";

                    $dados .= "</tr>";
                }
                $dados .= "</tbody>";
                $dados .= "</table>";
                $dados .= "</div>";

                // Paginação = Contando a quantidade de linhas
                $query_pg = "SELECT COUNT($order) AS num_result FROM $table;";
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
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listar(1)'>Primeira</a></li>";

                // Botão Anterior
                $ant_pag = $pagina;
                if (($pagina - 1) >= 1) {
                    $ant_pag = $pagina - 1;
                }
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listar($ant_pag)'>Anterior</a></li>";
                
                // Imprime os links baseado na $max_links (Botões numerados anteriores)
                for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) { 
                if ($pag_ant >= 1) {
                    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listar($pag_ant)'>$pag_ant</a></li>";
                }
                }

                $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";

                // Imprime os links baseado na $max_links (Botões numerados posteriores)
                for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) { 
                if ($pag_dep <= $quantidade_pg) {
                    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listar($pag_dep)'>$pag_dep</a></li>";
                }
                }

                // Botão Próximo
                $prox_pag = $pagina;
                if (($pagina + 1) <= $quantidade_pg) {
                $prox_pag = $pagina + 1;
                }
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listar($prox_pag)' >Próxima</a></li>";

                // Última página
                $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listar($quantidade_pg)'>Última</a></li>";
                $dados .= "</ul>";
                $dados .= "</nav>";
                
                $retorna = ['status' => true, 'dados' => $dados];
            } else {
                $retorna = ['status' => false, 'msg' => "<p style='color:'#f00'>Erro: Nenhum carro encontrado!</p>"];
            }

            // Converte a mensagem para Objeto e retorna para o Javascript
            return json_encode($retorna);

        } else {
            return "<div class='alert alert-danger' role='alert'>
            Nenhum registro encontrado!
        </div>";
        }
    }

?>