const listarCarros = async(pagina) => {
    
    // Aguarda para prosseguir até ter recebido os dados do listar-carros.php
    const dados = await fetch("./controller/listar-carros.php?pagina=" + pagina); //?pagina=" + pagina);
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

listarCarros(1);


// Cadastro de carro no Banco de Dados em PHP
const cadCarroForm = document.getElementById("cad-carro-form")

// Recebee o SELETOR da janela modal
const cadCarroModal = new bootstrap.Modal(document.getElementById("cadCarroModal"))


// Somente acessa o IF quando existir o SELETOR cad-carro-form
if (cadCarroForm) {
    // Aguarda o usuário clicar no botão salvar
    cadCarroForm.addEventListener("submit", async(e) => {
        // Não permitir a atualização da página
        e.preventDefault()

        // Testar se acessou a função
        // console.log("Acessou a função!")
        // Esse log vai aparecer em inspecionar >> console >> info 

        const dadosForm = new FormData(cadCarroForm);

        document.getElementById("cad-carro-btn").value = "Salvando..."

        // Aguarda o retorno da inserção
        const dados = await fetch("controller/inserir-carro.php", {
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
            cadCarroForm.reset();
            cadCarroModal.hide();
            listarCarros(1);
        }
        document.getElementById("cad-carro-btn").value = "Salvar"

    })
}

// Visualizar os dados do Carro
// async porque usa o await que espera a execução de algum retorno de dados antes de prosseguir para o próximo comando dentro da função
async function visCarro(codigo){
    
    
    // Se não utilizar o await ele não aguarda finalizar o retorno dos dados
    const dados = await fetch('./controller/visualizar-carro.php?codigo=' + codigo);

    // Recebe os dados processsados e transforma em objeto com json
    const resposta = await dados.json();

    //console.log(resposta)

    if(!resposta['status']){
        document.getElementById('msgAlerta').innerHTML = resposta['msg']
    } else {
        document.getElementById('msgAlerta').innerHTML = ""
        const visModal = new bootstrap.Modal(document.getElementById("visCarroModal"));
        visModal.show()

        document.getElementById("codCarro").innerHTML = resposta['dados'].carro_codigo;
        document.getElementById("marcaCarro").innerHTML = resposta['dados'].carro_marca;
        document.getElementById("corCarro").innerHTML = resposta['dados'].carro_cor;
        document.getElementById("aroCarro").innerHTML = resposta['dados'].carro_aro;
        document.getElementById("conversivelCarro").innerHTML = resposta['dados'].carro_conversivel;
        document.getElementById("placaCarro").innerHTML = resposta['dados'].carro_placa;
        document.getElementById("tipoCarro").innerHTML = resposta['dados'].carro_tipo;
        document.getElementById("precoCarro").innerHTML = resposta['dados'].carro_preco;
        document.getElementById("motorCarro").innerHTML = resposta['dados'].carro_motor;
        document.getElementById("velmaxCarro").innerHTML = resposta['dados'].carro_velocidademax;
    }
}

// Editar carros
// Recuperar os dados do banco de dados e mostrar no formulario
async function editCarro(codigo){
    // Oculta a mensagem de erro caso esteja com erro
    document.getElementById("msgAlertaErroEdit").innerHTML = "";
    // Pega os dados buscados do método visualizar-carro.php (retorna um carro peo código) e coloca na constante dados
    const dados = await fetch('./controller/visualizar-carro.php?codigo=' + codigo);
    // Aguarda os dados serem transformados em objeto e retorna na constante resposta
    const resposta = await dados.json();

    // Se os status da resposta for falso então imprime a mensagem de alerta na tela de nenhum registro retornado, caso contrário prossegue
    if (!resposta['status']) {
        document.getElementById('msgAlerta').innerHTML = resposta['msg'];
    } else {
        // Uma constante recebe o Modal criado no index.php por ID
        const editModal = new bootstrap.Modal(document.getElementById("editCarroModal"));
        // O Modal é mostrado na tela
        editModal.show();

        // Aqui são carregados os dados para cada campo no Modal
        document.getElementById('editcod').value = resposta['dados'].carro_codigo;
        document.getElementById("editmar").value = resposta['dados'].carro_marca;
        document.getElementById("editcor").value = resposta['dados'].carro_cor;
        document.getElementById("editaro").value = resposta['dados'].carro_aro;
        document.getElementById("editcon").value = resposta['dados'].carro_conversivel;
        document.getElementById("editpla").value = resposta['dados'].carro_placa;
        document.getElementById("edittip").value = resposta['dados'].carro_tipo;
        document.getElementById("editpre").value = resposta['dados'].carro_preco;
        document.getElementById("editmot").value = resposta['dados'].carro_motor;
        document.getElementById("editvel").value = resposta['dados'].carro_velocidademax;
    }
}

// Editar os dados no banco de dados
const editForm = document.getElementById('edit-carro-form');
if (editForm) {
    // Fica aguardando o submit do form edit-carro-form, quando clicado executa a função
    editForm.addEventListener("submit", async (e) => {
        // Para não recarregar a página
        e.preventDefault();

        // Coloca os dados do editForm em uma constante
        const dadosForm = new FormData(editForm);

        document.getElementById("edit-carro-btn").value = "Salvando..."

        // Envia os dados para o editar-carro.php que apenas aguarda os dados pelo método POST e os insere no banco
        const dados = await fetch("./controller/editar-carro.php", {
            // Chama o método POST do editar-carro.php
            method: "POST", 
            // Passa os dados
            body: dadosForm
        });

        const resposta = await dados.json();

        if (!resposta['status']) {
            document.getElementById("msgAlertaErroEdit").innerHTML = resposta['msg'];
        } else {
            document.getElementById("msgAlertaErroEdit").innerHTML = resposta['msg'];
            listarCarros(1);
        }

        document.getElementById("edit-carro-btn").value = "Salvar"

    });
}

// Apagar o registro no BD (Obs.: A função apagCarro vem do listar-carros.php que esta carregado no index.php e é executada quando o botão Apagar é clicado)
async function apagCarro(codigo) {

    // Exibe um alerta na tela confirmando a exclusão
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    // Caso a resposta seja positiva ele prossegue com a exclusão
    if (confirmar == true) {
        // Faz uma requisição para um arquivo php
        const dados = await fetch('./controller/apagar-carro.php?codigo=' + codigo);
        const resposta = await dados.json();

        if (!resposta['status']) {
            document.getElementById('msgAlerta').innerHTML = resposta['msg'];
        } else {
            document.getElementById('msgAlerta').innerHTML = resposta['msg'];
            listarCarros(1);
        }
    } else {
        // Não exclui
    }

    
}