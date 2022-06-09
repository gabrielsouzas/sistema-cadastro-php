<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manutenção de Carros</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .divform {
            margin: 5px;
            padding: 5px;
        }
        #divcarro {
            margin: 10px;
            padding: 10px;
            border: 1px solid black;
            border-radius: 8px;
            max-width: 350px;
        }

        input {
            float: right;
            overflow-x: auto;

        }

        h2 {
            background-color: gray;
            color: white;
            padding: 5px;
        }

        .btn {
            margin: 10px;
            background-color: gray;
            color: white;
        }

        label {
            font-weight: bold;
        }

        #btnsalvar {
            margin: 30px;
        }
        

    </style>
</head>

<body>
    
        <h2>Manutenção de Carros</h2>

        <?php
            include "/bean/carro.php";
            include "/dao/carrodao.php";

            /* Pega o carro selecionado na tabela da tela principal */
            if (isset($_GET["carro_selec"])) {
                $carro = new Carro();
                $carro = selecionar($_GET["carro_selec"]);
            }

            /* Método que é executado ao clicar no botão salvar desta tela
               O método que faz a chamada deste POST está em Javascript no final do código
            */
            if(isset($_POST["carrosalvar"])){
                $carro_salvar = json_decode($_POST['carrosalvar']); 
                /*alterar($carro_salvar);*/

                if (alterar($carro_salvar)) {
                    echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
                    echo "javascript:window.location='index.php';</script>";
                } else {
                    echo "<script type='javascript'>alert('Email enviado com Sucesso!');";
                }
            }

        ?>

    <div id="divcarro">
        <form id="form" method="post">
            <div class="divform">
                <label for="lbl" class="label">Código:</label>
                <input type="text" class="text" id="cod" value="<?=$carro->getCodigo() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Marca:</label>
                <input type="text" class="text" id="mar" value="<?=$carro->getMarca() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Cor:</label>
                <input type="text" class="text" id="cor" value="<?=$carro->getCor() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Aro:</label>
                <input type="text" class="text" id="aro" value="<?=$carro->getAro() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Conversível:</label>
                <input type="text" class="text" id="con" value="<?=$carro->getConversivel() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Placa:</label>
                <input type="text" class="text" id="pla" value="<?=$carro->getPlaca() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Tipo:</label>
                <input type="text" class="text" id="tip" value="<?=$carro->getTipo() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Preço:</label>
                <input type="text" class="text" id="pre" value="<?=$carro->getPreco() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Motor:</label>
                <input type="text" class="text" id="mot" value="<?=$carro->getMotor() ?>">
            </div>
            <div class="divform">
                <label for="lbl" class="label">Vel. Max:</label>
                <input type="text" class="text" id="vel" value="<?=$carro->getVelocidademax() ?>">
            </div>
            <input class="btn" id="btnsalvar" type="submit" value="Salvar">
        </form>
    </div>

        <div>
            <a class="btn" href="index.php">Voltar</a>
        </div>
        


        <script type="text/javascript">
            /* Botão que ao clicar executara os métodos para salvamento de um carro */
            var btnsalvar = document.getElementById('btnsalvar'); 
            
            /* Listener que fica escutando o botão Salvar, que ao clicar chama o método POST que está no inicio da tela em PHP que faz a alteração/inserção de um carro*/
            btnsalvar.addEventListener('click', function(e){ 
            
                /* Objeto carro que recebe todos os atributos passados pelo html */
            let carro = {
                    carro_codigo: (document.getElementById('cod')).value,
                    carro_marca: (document.getElementById('mar')).value,
                    carro_cor: (document.getElementById('cor')).value,
                    carro_aro: (document.getElementById('aro')).value,
                    carro_conversivel: (document.getElementById('con')).value,
                    carro_placa: (document.getElementById('pla')).value,
                    carro_tipo: (document.getElementById('tip')).value,
                    carro_preco: (document.getElementById('pre')).value,
                    carro_motor: (document.getElementById('mot')).value,
                    carro_velocidademax: (document.getElementById('vel')).value,
                };

                var form = document.getElementById('form'); 
                var m = document.createElement("INPUT"); 
                m.setAttribute("type", "hidden"); 
                m.setAttribute("name", "carrosalvar"); 
                m.setAttribute("value",JSON.stringify(carro)); 
                form.appendChild(m);
            });
        </script>
</body>

</html>