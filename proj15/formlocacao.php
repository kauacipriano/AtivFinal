<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/geral.css" media="screen" />
    <title>Document</title>

</head>
<body onload="consultalocacao()">

<h1>Locadora EKMovies</h1>

<div class="container">
       
        <div id="sidebar">
            <div class="sidebar-field">
                <a href="formfilme.php" class="sidebar-item text-dark">Cadastro de Filmes
                </a>
            </div>
            <div class="sidebar-field">
                <a href="formcliente.php" class="sidebar-item text-dark">Cadastro do Cliente
                </a>
            </div>
            <div class="sidebar-field">
                <a href="formlocacao.php" class="sidebar-item text-dark">Filmes para Locação
                </a>
            </div>
            <div class="sidebar-field">
                <a href="formavaliacao.php" class="sidebar-item text-dark" >Avaliação
                </a>
            </div>
        </div>


        <div id="formulario">
            <form action="contrlocacao.php" method="get">

             <label for="id_locacao">ID da locacao</label>
            <input type="number" name="id_locacao" id="id_locacao"> <br>

             <label for="id_cliente">ID do cliente</label>
             <input type="number" name="id_cliente" id="id_cliente"> <br>

             <label for="id_filme"> ID do filme</label>
             <input type="number" name="id_filme" id="id_filme"> <br>

             <label for="data_locacao">Data de locação</label>
             <input type="date" name="data_locacao" id="data_locacao"> <br>

             <label for="data_locacao">Data de devolução</label>
             <input type="date" name="data_devolucao" id="data_devolucao"> <br> <br>

             <input type="submit" name="gravar" id="gravar" value="Gravar">
             <input type="submit" name="deletar" id="deletar" value="Deletar">

            </form>
        </div>
    </div>

    <h2>Lista de locações feitas</h2>

    <div id="resultadolocacao">

    </div>

    <script>

        function consultalocacao() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "contrlocacao.php?listalocacao", true);
        xhttp.send();

        xhttp.onload = function() {
        console.log("Resposta do servidor:", this.responseText);
        try {
          var resposta = JSON.parse(this.responseText);
            var organizar = "<table><thead><tr><th>ID</th><th>Cliente</th><th>Filme</th><th>Data de locação</th><th>Data de devolução</th></tr></thead><tbody>";

         if (resposta.erro) {
        document.getElementById('resultadolocacao').innerHTML = resposta.erro;
        return;
}

        for (var i = 0; i < resposta.length; i++) {
         organizar += "<tr><td>" + resposta[i].id_locacao + "</td>" +
            "<td>" + resposta[i].nome_cliente + "</td>" +
            "<td>" + resposta[i].titulo_filme + "</td>" +
            "<td>" + resposta[i].data_locacao + "</td>" +
            "<td>" + resposta[i].data_devolucao + "</td>" +
            "</tr>";
}

        organizar += "</tbody></table>";
        document.getElementById('resultadolocacao').innerHTML = organizar;

} catch (error) {
    console.error("Erro ao processar a resposta JSON:", error);
    document.getElementById('resultadolocacao').innerHTML = "Erro ao carregar as locações.";
}
}


xhttp.onerror = function() {
    console.error("Erro ao tentar fazer a requisição.");
    document.getElementById('resultadolocacao').innerHTML = "<p>Erro ao fazer a requisição.</p>";
};
}

</script>
</body>
</html>