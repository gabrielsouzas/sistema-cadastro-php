<?php
      include_once "../controller/conexao.php";
      include "../login/protect.php";
  ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Venda Automotiva</title>
    
    <!-- Bootstrap -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/dashboard/">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilo customizado para esse template -->
    <link href="../css/dashboard.css" rel="stylesheet">
    
    <!-- Estilo manual -->
    <link rel="stylesheet" href="../css/estilo.css">   
    
    <!-- Resolver erro favicon.ico not found (404) -->
    <!--<link rel="icon" href="data:;base64,iVBORw0KGgo=">-->
    <link rel="shortcut icon" href="#">

  </head>
  <body>
  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a id="system-name" class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">CadCars.com</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Buscar" aria-label="Search">
    <div class="navbar-nav">
      
      <div class="nav-item text-nowrap">
        <a class="nav-link px-3" href="../login/logoff.php">Sair</a>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <span data-feather="home" class="align-text-bottom"></span>
                Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file" class="align-text-bottom"></span>
                Ordens
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart" class="align-text-bottom"></span>
                Produtos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users" class="align-text-bottom"></span>
                Clientes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2" class="align-text-bottom"></span>
                Relat??rios
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="layers" class="align-text-bottom"></span>
                Integra????es
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Relat??rios Salvos</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                M??s atual
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                ??ltima Semana
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Engajamento Social
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Venda de Fim de Ano
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="user-name">Bem vindo <?php echo " " . $_SESSION['nome']; ?></div>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
         
          <h1 id="table-title" class="h2">Carros Cadastrados</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
              <button id="cadastrar-carro" type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#cad-carro-modal">Cadastrar Carro</button>
              <!--<button type="button" class="btn btn-sm btn-outline-secondary">Exportar</button>-->
            </div>
          </div>
        </div>

        
        

        <!--<canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>-->
        <div>
          <span id="msgAlerta"></span>
        </div>
        <!--<div class="table-responsive">-->
            <span class="listar-carro"></span>

          <!-- Configura????o da tabela anterior
          <table class="table table-secondary table-striped table-sm">
            <thead>
              <tr>
                  <th scope="col">C??digo</th>
                  <th scope="col">Marca</th>
                  <th scope="col">Cor</th>
                  <th scope="col">Aro</th>
                  <th scope="col">Conversivel</th>
                  <th scope="col">Placa</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Pre??o</th>
                  <th scope="col">Motor</th>
                  <th scope="col">Velocidade Max.</th>
                  <th scope="col">Visualizar</th>
              </tr>
            </thead>
            <tbody>
            <?php
                  /*

                  $dados = buscar_carros();
                  // transforma os dados em um array
                  $linha = pg_fetch_assoc($dados);
                  // calcula quantos dados retornaram
                  $total = pg_num_rows($dados);

                // se o n??mero de resultados for maior que zero, mostra os dados
                if($total > 0) {
              // inicia o loop que vai mostrar todos os dados
              do {
                */
              ?>
              <tr>
                  <td><?//=$linha['carro_codigo']?></td>
                  <td><?//=$linha['carro_marca']?></td>
                  <td><?//=$linha['carro_cor']?></td>
                  <td><?//=$linha['carro_aro']?></td>
                  <td><?//=$linha['carro_conversivel']?></td>
                  <td><?//=$linha['carro_placa']?></td>
                  <td><?//=$linha['carro_tipo']?></td>
                  <td><?//=$linha['carro_preco']?></td>
                  <td><?//=$linha['carro_motor']?></td>
                  <td><?//=$linha['carro_velocidademax']?></td>
                  <td>
                    <form action="cadastro-carro.php" method="get">
                    <input class="btn btn-outline-secondary" id="btn_tabela" type="submit" name="carro_selec" value="Visualizar">
                    </form>
                  </td>
              </tr>
              <?php
                // finaliza o loop que vai mostrar os dados
                /*}while($linha = pg_fetch_assoc($dados));
                  // fim do if
                }*/
              ?>
            </tbody>
          </table>-->

        <!--</div>-->
      </main>
    </div>
  </div>

  <!-- Inicio Model Cadastrar Carro-->
  <div class="modal fade" id="cad-carro-modal" tabindex="-1" aria-labelledby="cadCarroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cadCarroModalLabel">Cadastrar Carro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span id="msgAlertaErro"></span>
        <form id="cad-carro-form">
        
        <div class="row mb-3">
          <label for="cod" class="col-sm-2 col-form-label">C??digo</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_codigo" id="carro_codigo">
          </div>
        </div>
        <div class="row mb-3">
        <label for="mar" class="col-sm-2 col-form-label">Marca:</label>
          <div class="col-sm-10">
                <input type="text" class="form-control" name="carro_marca" id="carro_marca" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="cor" class="col-sm-2 col-form-label">Cor:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_cor" id="carro_cor" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="aro" class="col-sm-2 col-form-label">Aro:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_aro" id="carro_aro" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="con" class="col-sm-2 col-form-label">Convers??vel:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_conversivel" id="carro_conversivel" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="pla" class="col-sm-2 col-form-label">Placa:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_placa" id="carro_placa" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="tip" class="col-sm-2 col-form-label">Tipo:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_tipo" id="carro_tipo" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="pre" class="col-sm-2 col-form-label">Pre??o:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_preco" id="carro_preco" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="mot" class="col-sm-2 col-form-label">Motor:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_motor" id="carro_motor" required>
          </div>
        </div>
        <div class="row mb-3">
            <label for="vel" class="col-sm-2 col-form-label">Vel. Max:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="carro_velocidademax" id="carro_velocidademax" required>
          </div>
        </div>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <input type="submit" class="btn btn-primary" id="cad-carro-btn" value="Salvar">

        </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Fim Model Cadastrar Carro-->

  <!-- Inicio Model Visualizar Carro-->
  <div class="modal fade" id="vis-carro-modal" tabindex="-1" aria-labelledby="visCarroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="visCarroModalLabel">Visualizar Carro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span id="msgAlertaErroVis"></span>
          <dl class="row">
            <dt class="col-sm-3">C??digo</dt>
            <dd class="col-sm-9"><span id="vis_carro_codigo"></span></dd>
            
            <dt class="col-sm-3">Marca</dt>
            <dd class="col-sm-9"><span id="vis_carro_marca"></span></dd>
            
            <dt class="col-sm-3">Cor</dt>
            <dd class="col-sm-9"><span id="vis_carro_cor"></span></dd>
            
            <dt class="col-sm-3">Aro</dt>
            <dd class="col-sm-9"><span id="vis_carro_aro"></span></dd>
            
            <dt class="col-sm-3">Convers??vel</dt>
            <dd class="col-sm-9"><span id="vis_carro_conversivel"></span></dd>
            
            <dt class="col-sm-3">Placa</dt>
            <dd class="col-sm-9"><span id="vis_carro_placa"></span></dd>
            
            <dt class="col-sm-3">Tipo</dt>
            <dd class="col-sm-9"><span id="vis_carro_tipo"></span></dd>
            
            <dt class="col-sm-3">Pre??o</dt>
            <dd class="col-sm-9"><span id="vis_carro_preco"></span></dd>
            
            <dt class="col-sm-3">Motor</dt>
            <dd class="col-sm-9"><span id="vis_carro_motor"></span></dd>
            
            <dt class="col-sm-4">Velocidade M??x.</dt>
            <dd class="col-sm-9"><span id="vis_carro_velocidademax"></span></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
  <!-- Fim Model Visualizar Carro-->

  <!-- Inicio Model Editar Carro-->
  <div class="modal fade" id="edit-carro-modal" tabindex="-1" aria-labelledby="editCarroModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCarroModalLabel">Editar Carro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <span id="msgAlertaErroEdit"></span>

          <form id="edit-carro-form">
          
          <div class="row mb-3">
            <label for="cod" class="col-sm-2 col-form-label">C??digo</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_codigo" id="edit-carro_cod" readonly>
            </div>
          </div>

          <div class="row mb-3">
          <label for="mar" class="col-sm-2 col-form-label">Marca:</label>
            <div class="col-sm-10">
                  <input type="text" class="form-control" name="carro_marca" id="edit-carro_mar" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="cor" class="col-sm-2 col-form-label">Cor:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_cor" id="edit-carro_cor" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="aro" class="col-sm-2 col-form-label">Aro:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_aro" id="edit-carro_aro" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="con" class="col-sm-2 col-form-label">Convers??vel:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_conversivel" id="edit-carro_conversivel" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="pla" class="col-sm-2 col-form-label">Placa:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_placa" id="edit-carro_placa" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="tip" class="col-sm-2 col-form-label">Tipo:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_tipo" id="edit-carro_tipo" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="pre" class="col-sm-2 col-form-label">Pre??o:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_preco" id="edit-carro_preco" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="mot" class="col-sm-2 col-form-label">Motor:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_motor" id="edit-carro_motor" required>
            </div>
          </div>
          <div class="row mb-3">
              <label for="vel" class="col-sm-2 col-form-label">Vel. Max:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="carro_velocidademax" id="edit-carro_velocidademax" required>
            </div>
          </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" id="edit-carro-btn" value="Salvar">

          </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Fim Model Editar Carro-->

    <script src="../js/bootstrap.bundle.min.js"></script>
    
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="../js/dashboard.js"></script>
      
      <script src="../js/interacao.js"></script>
    </body>
</html>
