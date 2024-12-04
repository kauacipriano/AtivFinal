<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/geral.css" media="screen" />
    <title>Locadora EKMovies</title>

</head>
<body onload="consultaavaliacao()">

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
            <form action="contravaliacao.php" method="get">
                <label for="id_avaliacao">ID da avaliação</label>
                <input type="number" name="id_avaliacao" id="id_avaliacao"> <br>

                <label for="id_cliente">ID do cliente</label>
                <input type="number" name="id_cliente" id="id_cliente"> <br>

                <label for="id_filme">ID do filme</label>
                <input type="number" name="id_filme" id="id_filme"> <br>

                <label for="data_avaliacao">Data da avaliação</label>
                <input type="date" name="data_avaliacao" id="data_avaliacao"> <br>

                <label for="nota_avaliacao">Nota</label>
                <div class="stars">
                    <input type="radio" name="nota_avaliacao" id="star5" value="5">
                    <label for="star5">&#9733;</label>
                    <input type="radio" name="nota_avaliacao" id="star4" value="4">
                    <label for="star4">&#9733;</label>
                    <input type="radio" name="nota_avaliacao" id="star3" value="3">
                    <label for="star3">&#9733;</label>
                    <input type="radio" name="nota_avaliacao" id="star2" value="2">
                    <label for="star2">&#9733;</label>
                    <input type="radio" name="nota_avaliacao" id="star1" value="1">
                    <label for="star1">&#9733;</label>
                </div> <br>

                <label for="comentario_avaliacao">Comentário</label>
                <input type="text" name="comentario_avaliacao" id="comentario_avaliacao"> <br> <br>

                <input type="submit" name="gravar" id="gravar" value="Gravar">
                <input type="submit" name="deletar" id="deletar" value="Deletar">

            </form>
        </div>
    </div>

    <h2>Lista de avaliações feitas</h2>

    <div id="resultadoavaliacao">
    
    </div>

    <script>
    
    function consultaavaliacao() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "contravaliacao.php?listaavaliacao", true);
    xhttp.send();

    xhttp.onload = function() {
    console.log("Resposta do servidor:", this.responseText);
    try {
        var resposta = JSON.parse(this.responseText);
        var organizar = "<table><thead><tr><th>ID</th><th>Cliente</th><th>Filme</th><th>Data da avaliação</th><th>Nota</th><th>Comentario</th></tr></thead><tbody>";

        if (resposta.erro) {
            document.getElementById('resultadoavaliacao').innerHTML = resposta.erro;
            return;
        }

        for (var i = 0; i < resposta.length; i++) {
            organizar += "<tr><td>" + resposta[i].id_avaliacao + "</td>" +
                "<td>" + resposta[i].nome_cliente + "</td>" +
                "<td>" + resposta[i].titulo_filme + "</td>" +
                "<td>" + resposta[i].data_avaliacao + "</td>" +
                "<td>" + resposta[i].nota_avaliacao + "</td>" +
                "<td>" + resposta[i].comentario_avaliacao + "</td>" +
                "</tr>";
        }

        organizar += "</tbody></table>";
        document.getElementById('resultadoavaliacao').innerHTML = organizar;

    } catch (error) {
        console.error("Erro ao processar a resposta JSON:", error);
        document.getElementById('resultadoavaliacao').innerHTML = "Erro ao carregar as avaliações.";
    }
}


    xhttp.onerror = function() {
        console.error("Erro ao tentar fazer a requisição.");
        document.getElementById('resultadoavaliacao').innerHTML = "<p>Erro ao fazer a requisição.</p>";
    };
}

</script>
</body>
</html>