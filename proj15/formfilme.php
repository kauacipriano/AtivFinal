<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/geral.css" media="screen" />
    <title>Locadora EKMovies</title>

</head>
<body onload="consultafilme()">

    <h1>Locadora EKMovies</h1>


    <div class="container">
       
        <div id="sidebar">
            <div class="sidebar-field">
                <a href="formfilme.php" class="sidebar-item text-dark">Cadastro de Filmes</a>
            </div>
            <div class="sidebar-field">
                <a href="formcliente.php" class="sidebar-item text-dark">Cadastro do Cliente</a>
            </div>
            <div class="sidebar-field">
                <a href="formlocacao.php" class="sidebar-item text-dark">Filmes para Locação</a>
            </div>
            <div class="sidebar-field">
                <a href="formavaliacao.php" class="sidebar-item text-dark">Avaliação</a>
            </div>
        </div>



      

        <div id="formulario">
            <form action="contrfilme.php" method="get">
                <label for="id_filme">ID do filme</label>
                <input type="number" name="id_filme" id="id_filme"> <br>

                <label for="titulo_filme">Título</label>
                <input type="text" name="titulo_filme" id="titulo_filme"> <br>

                <label for="genero_filme">Gênero</label>
                <input type="text" name="genero_filme" id="genero_filme"> <br>

                <label for="ano_lancamento_filme">Ano de lançamento</label>
                <input type="number" name="ano_lancamento_filme" id="ano_lancamento_filme"> <br>

                <label for="preco_locacao_filme">Preço de locação</label>
                <input type="number" name="preco_locacao_filme" id="preco_locacao_filme" step="0.01"> <br>

                <label for="estoque_filme">Quantidade de estoque</label>
                <input type="number" name="estoque_filme" id="estoque_filme"> <br><br>

                <input type="submit" name="gravar" id="gravar" value="Gravar">
                <input type="submit" name="deletar" id="deletar" value="Deletar">

            </form>
        </div>

        
</div>

<h2>Lista de filmes cadastrados</h2>

        <div id="resultadofilme">
    
</div>


<script>
    
    function consultafilme() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "contrfilme.php?listafilme", true);
    xhttp.send();

    xhttp.onload = function() {
    console.log("Resposta do servidor:", this.responseText);
    try {
        var resposta = JSON.parse(this.responseText);
        var organizar = "<table><thead><tr><th>ID</th><th>Titulo</th><th>Genero</th><th>Ano de lançamento</th><th>Preço</th><th>Estoque</th></tr></thead><tbody>";

        if (resposta.erro) {
            document.getElementById('resultadofilme').innerHTML = resposta.erro;
            return;
        }

        for (var i = 0; i < resposta.length; i++) {
            organizar += "<tr><td>" + resposta[i].id_filme + "</td>" +
                "<td>" + resposta[i].titulo_filme + "</td>" +
                "<td>" + resposta[i].genero_filme + "</td>" +
                "<td>" + resposta[i].ano_lancamento_filme + "</td>" +
                "<td>" + resposta[i].preco_locacao_filme + "</td>" +
                "<td>" + resposta[i].estoque_filme + "</td>" +
                "</tr>";
        }

        organizar += "</tbody></table>";
        document.getElementById('resultadofilme').innerHTML = organizar;

    } catch (error) {
        console.error("Erro ao processar a resposta JSON:", error);
        document.getElementById('resultadofilme').innerHTML = "Erro ao carregar os filmes.";
    }
}


    xhttp.onerror = function() {
        console.error("Erro ao tentar fazer a requisição.");
        document.getElementById('resultadofilme').innerHTML = "<p>Erro ao fazer a requisição.</p>";
    };
}

</script>
</body>
</html>
