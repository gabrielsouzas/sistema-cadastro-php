const listarCarros = async(pagina) => {
    
    // Aguarda para prosseguir até ter recebido os dados do listar-carros.php
    const dados = await fetch("../controller/listar-carros.php?pagina=" + pagina); //?pagina=" + pagina);
    // Retorno de objetos
    const resposta = await dados.json();
    

    // Verifica se o indice status retornou true ou false
    if (!resposta['status']) {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        const conteudo = document.querySelector(".listar-carros");
        if (conteudo) {
            // Se existir o seletor no index.html ele insere neste seletor a resposta do listar-carros.php com o indice 'dados'
            conteudo.innerHTML = resposta['dados'];
        }
    }
}

//listarCarros(1);

const listar = async(pagina, tabela) => {
    
    // Aguarda para prosseguir até ter recebido os dados do listar-'nome_da_tabela'.php
    const dados = await fetch("../controller/listar-"+tabela+".php?pagina=" + pagina); //?pagina=" + pagina);
    // Retorno de objetos
    const resposta = await dados.json();
    

    // Verifica se o indice status retornou true ou false
    if (!resposta['status']) {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    } else {
        const conteudo = document.querySelector(".listar-"+tabela);
        if (conteudo) {
            // Se existir o seletor no index.html ele insere neste seletor a resposta do listar-'nome_da_tabela'.php com o indice 'dados'
            conteudo.innerHTML = resposta['dados'];
        }
    }
}

listar(1, "carro");

const btnCadastrar = document.querySelector("#cadastrar-carro");
var operacao = "inserir";

if (btnCadastrar) {
    btnCadastrar.addEventListener("onclick", () => {
        operacao = "inserir"
    })
}

// Cadastro de um registro no Banco de Dados em PHP
function cadastrar(tabela) {
    const cadForm = document.getElementById("cad-"+tabela+"-form")
    
    // Recebee o SELETOR da janela modal
    const cadModal = new bootstrap.Modal(document.getElementById("cad-"+tabela+"-modal"))

    // Somente acessa o IF quando existir o SELETOR cad-tabela-form
    if (cadForm) {
        
        // Aguarda o usuário clicar no botão salvar
        cadForm.addEventListener("submit", async(e) => {
            // Não permitir a atualização da página
            e.preventDefault()

            // Testar se acessou a função
            // console.log("Acessou a função!")
            // Esse log vai aparecer em inspecionar >> console >> info 

            const dadosForm = new FormData(cadForm);
            
            document.getElementById("cad-"+tabela+"-btn").value = "Salvando..."
            
            // Aguarda o retorno da inserção
            const dados = await fetch("../controller/"+operacao+"-"+tabela+".php", {
                method: "POST",
                body: dadosForm
            });

            const resposta = await dados.json();

            // Acessa o IF quando não cadastrar com sucesso
            // Neste caso ele acessa o indice status que foi criado para esse objeto e verifica se ele é falso ou verdadeiro
            if (!resposta['status']) {
                document.getElementById("msgAlertaErro").innerHTML = resposta['msg'];
                document.getElementById("msgAlerta").innerHTML = "";
            } else {
                document.getElementById("msgAlertaErro").innerHTML = "";
                document.getElementById("msgAlerta").innerHTML = resposta['msg'];
                cadForm.reset();
                cadModal.hide();
                listar(1, tabela);
            }
            document.getElementById("cad-"+tabela+"-btn").value = "Salvar"
            
        })
    }
}

// Chamada da função de cadastro para criar o eventListener
cadastrar("carro")

// Visualizar os dados do Carro
// async porque usa o await que espera a execução de algum retorno de dados antes de prosseguir para o próximo comando dentro da função
async function visualizar(codigo, tabela){
    //console.log(codigo);
    
    // Se não utilizar o await ele não aguarda finalizar o retorno dos dados
    const dados = await fetch('../controller/visualizar-'+tabela+'.php?codigo=' + codigo);

    // Recebe os dados processsados e transforma em objeto com json
    const resposta = await dados.json();

    //console.log(resposta)

    if(!resposta['status']){
        document.getElementById('msgAlerta').innerHTML = resposta['msg']
    } else {
        document.getElementById('msgAlerta').innerHTML = ""
        const visModal = new bootstrap.Modal(document.getElementById(`vis-${tabela}-modal`));
        visModal.show()

        //const visForm = document.getElementById("vis-"+tabela+"-form")

        const campos = [
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
        
        //if (visForm) {
            //const dadosForm = new FormData(visForm);
                
            var campo;
            campos.forEach((number, index) => {
                campo = document.getElementById("vis_" + number.toString());
                if (campo) {
                    campo.innerHTML = resposta['dados'][number.toString()];
                }
            });
        //}
        /*
        document.getElementById("codCarro").innerHTML = resposta['dados'].carro_codigo;
        document.getElementById("marcaCarro").innerHTML = resposta['dados'].carro_marca;
        document.getElementById("corCarro").innerHTML = resposta['dados'].carro_cor;
        document.getElementById("aroCarro").innerHTML = resposta['dados'].carro_aro;
        document.getElementById("conversivelCarro").innerHTML = resposta['dados'].carro_conversivel;
        document.getElementById("placaCarro").innerHTML = resposta['dados'].carro_placa;
        document.getElementById("tipoCarro").innerHTML = resposta['dados'].carro_tipo;
        document.getElementById("precoCarro").innerHTML = resposta['dados'].carro_preco;
        document.getElementById("motorCarro").innerHTML = resposta['dados'].carro_motor;
        document.getElementById("velmaxCarro").innerHTML = resposta['dados'].carro_velocidademax;*/
    }
}

// Editar carros
// Recuperar os dados do banco de dados e mostrar no formulario
async function editShow(codigo, tabela){
    operacao = "editar"
    // Oculta a mensagem de erro caso esteja com erro
    document.getElementById("msgAlertaErroEdit").innerHTML = "";
    // Pega os dados buscados do método visualizar-carro.php (retorna um carro peo código) e coloca na constante dados
    const dados = await fetch('../controller/visualizar-'+tabela+'.php?codigo=' + codigo);
    // Aguarda os dados serem transformados em objeto e retorna na constante resposta
    const resposta = await dados.json();

    // Se os status da resposta for falso então imprime a mensagem de alerta na tela de nenhum registro retornado, caso contrário prossegue
    if (!resposta['status']) {
        document.getElementById('msgAlerta').innerHTML = resposta['msg'];
    } else {
        
        const cadForm = document.getElementById("cad-"+tabela+"-form")

        // Uma constante recebe o Modal criado no index.php por ID
        const editModal = new bootstrap.Modal(document.getElementById(`cad-${tabela}-modal`));
        // O Modal é mostrado na tela
        editModal.show();

        if (cadForm) {
            const dadosForm = new FormData(cadForm);
            
            var campo;
            dadosForm.forEach((number, index) => {
                campo = document.getElementById(index.toString());
                if (campo) {
                    campo.value = resposta['dados'][index.toString()];
                }
            });
        }

        /*
        colunas.forEach(col => {
            document.getElementById(`edit-${col}`).value = resposta['dados'].col;
        });*/

        // Aqui são carregados os dados para cada campo no Modal
        /*document.getElementById('editcod').value = resposta['dados'].carro_codigo;
        document.getElementById("editmar").value = resposta['dados'].carro_marca;
        document.getElementById("editcor").value = resposta['dados'].carro_cor;
        document.getElementById("editaro").value = resposta['dados'].carro_aro;
        document.getElementById("editcon").value = resposta['dados'].carro_conversivel;
        document.getElementById("editpla").value = resposta['dados'].carro_placa;
        document.getElementById("edittip").value = resposta['dados'].carro_tipo;
        document.getElementById("editpre").value = resposta['dados'].carro_preco;
        document.getElementById("editmot").value = resposta['dados'].carro_motor;
        document.getElementById("editvel").value = resposta['dados'].carro_velocidademax;*/
    }
}

// Editar os dados no banco de dados
function editar(tabela) {
    const editForm = document.getElementById(`cad-${tabela}-form`);
    if (editForm) {
        // Fica aguardando o submit do form edit-carro-form, quando clicado executa a função
        editForm.addEventListener("submit", async (e) => {
            // Para não recarregar a página
            e.preventDefault();

            // Coloca os dados do editForm em uma constante
            const dadosForm = new FormData(editForm);

            document.getElementById(`cad-${tabela}-btn`).value = "Salvando..."

            // Envia os dados para o editar-carro.php que apenas aguarda os dados pelo método POST e os insere no banco
            const dados = await fetch("../controller/editar-"+tabela+".php", {
                // Chama o método POST do editar-tabela.php
                method: "POST", 
                // Passa os dados
                body: dadosForm
            });

            const resposta = await dados.json();

            if (!resposta['status']) {
                document.getElementById("msgAlertaErroEdit").innerHTML = resposta['msg'];
            } else {
                document.getElementById("msgAlertaErroEdit").innerHTML = resposta['msg'];
                listar(1, tabela);
            }

            document.getElementById(`cad-${tabela}-btn`).value = "Salvar"

        });
    }
}

//editar("carro");

// Apagar o registro no BD (Obs.: A função apagCarro vem do listar-carros.php que esta carregado no index.php e é executada quando o botão Apagar é clicado)
async function apagar(codigo, tabela) {

    // Exibe um alerta na tela confirmando a exclusão
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    // Caso a resposta seja positiva ele prossegue com a exclusão
    if (confirmar == true) {
        // Faz uma requisição para um arquivo php
        const dados = await fetch('../controller/apagar-'+tabela+'.php?codigo=' + codigo);
        const resposta = await dados.json();

        if (!resposta['status']) {
            document.getElementById('msgAlerta').innerHTML = resposta['msg'];
        } else {
            document.getElementById('msgAlerta').innerHTML = resposta['msg'];
            listar(1, tabela);
        }
    } else {
        // Não exclui
    }

    
}