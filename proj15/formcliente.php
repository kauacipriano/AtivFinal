<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/geral.css" media="screen" />
    <title>Locadora EKMovies</title>

</head>
<body onload="consultacliente()">

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
            <form action="contrcliente.php" method="get">
                <label for="id_cliente">ID do cliente</label>
                <input type="number" name="id_cliente" id="id_cliente"> <br>

                <label for="nome_cliente">Nome</label>
                <input type="text" name="nome_cliente" id="nome_cliente"> <br>

                <label for="cpf_cliente">CPF</label>
                <input type="text" name="cpf_cliente" id="cpf_cliente"> <br>

                <label for="data_nasc_cliente">Data de nascimento</label>
                <input type="date" name="data_nasc_cliente" id="data_nasc_cliente"> <br>

                <label for="telefone_cliente">Telefone</label>
                <input type="text" name="telefone_cliente" id="telefone_cliente"> <br>

                <label for="email_cliente">Email</label>
                <input type="email" name="email_cliente" id="email_cliente"> <br><br>

                <input type="submit" name="gravar" id="gravar" value="Gravar">
                <input type="submit" name="deletar" id="deletar" value="Deletar">

            </form>
        </div>
    </div>

    <h2>Lista de clientes cadastrados</h2>

    <div id="resultadocliente">
    
    </div>

    <script>
    
    function consultacliente() {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", "contrcliente.php?listacliente", true);
    xhttp.send();

    xhttp.onload = function() {
    console.log("Resposta do servidor:", this.responseText);
    try {
        var resposta = JSON.parse(this.responseText);
        var organizar = "<table><thead><tr><th>ID</th><th>Nome</th><th>CPF</th><th>Data de nascimento</th><th>Telefone</th><th>Email</th></tr></thead><tbody>";

        if (resposta.erro) {
            document.getElementById('resultadocliente').innerHTML = resposta.erro;
            return;
        }

        for (var i = 0; i < resposta.length; i++) {
            organizar += "<tr><td>" + resposta[i].id_cliente + "</td>" +
                "<td>" + resposta[i].nome_cliente + "</td>" +
                "<td>" + resposta[i].cpf_cliente + "</td>" +
                "<td>" + resposta[i].data_nasc_cliente + "</td>" +
                "<td>" + resposta[i].telefone_cliente + "</td>" +
                "<td>" + resposta[i].email_cliente + "</td>" +
                "</tr>";
        }

        organizar += "</tbody></table>";
        document.getElementById('resultadocliente').innerHTML = organizar;

    } catch (error) {
        console.error("Erro ao processar a resposta JSON:", error);
        document.getElementById('resultadocliente').innerHTML = "Erro ao carregar os clientes.";
    }
}


    xhttp.onerror = function() {
        console.error("Erro ao tentar fazer a requisição.");
        document.getElementById('resultadocliente').innerHTML = "<p>Erro ao fazer a requisição.</p>";
    };
}

</script>
</body>
</html>
