<?php

include_once "clsfilme.php";
$clsf = new clsfilme();


$id_filme               = isset($_GET["id_filme"]) ? $_GET["id_filme"] : null;
$titulo_filme           = isset($_GET["titulo_filme"]) ? $_GET["titulo_filme"] : null;
$genero_filme           = isset($_GET["genero_filme"]) ? $_GET["genero_filme"] : null;
$ano_lancamento_filme   = isset($_GET["ano_lancamento_filme"]) ? $_GET["ano_lancamento_filme"] : null;
$preco_locacao_filme    = isset($_GET["preco_locacao_filme"]) ? $_GET["preco_locacao_filme"] : null;
$estoque_filme          = isset($_GET["estoque_filme"]) ? $_GET["estoque_filme"] : null;



$preco_locacao_filme = number_format((float)$preco_locacao_filme, 2, '.', '');


$clsf->setid_filme($id_filme);
$clsf->settitulo_filme($titulo_filme);
$clsf->setgenero_filme($genero_filme);
$clsf->setano_lancamento_filme($ano_lancamento_filme);
$clsf->setpreco_locacao_filme($preco_locacao_filme);
$clsf->setestoque_filme($estoque_filme);


if (isset($_GET["gravar"])) {
    echo $clsf->gravar(); 
} else if (isset($_GET["deletar"])) {
    echo $clsf->deletar();
} else if (isset($_GET['listafilme'])) {
    $resultados = $clsf->consultafilme();
    if (is_array($resultados) && !empty($resultados)) {
        echo json_encode($resultados);
    } else {
        echo json_encode(["erro" => "Nenhum filme encontrado."]);
    }
}

