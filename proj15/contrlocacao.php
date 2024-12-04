<?php

include_once "clslocacao.php";
$clsl = new clslocacao();

$id_locacao     = isset($_GET["id_locacao"]) ? $_GET["id_locacao"] : null;
$id_cliente     = isset($_GET["id_cliente"]) ? $_GET["id_cliente"] : null;
$id_filme       = isset($_GET["id_filme"]) ? $_GET["id_filme"] : null;
$data_locacao   = isset($_GET["data_locacao"]) ? $_GET["data_locacao"] : null;
$data_devolucao = isset($_GET["data_devolucao"]) ? $_GET["data_devolucao"] : null;



$clsl -> setid_locacao ($id_locacao);
$clsl -> setid_cliente ($id_cliente);
$clsl -> setid_filme ($id_filme);
$clsl -> setdata_locacao ($data_locacao);
$clsl -> setdata_devolucao ($data_devolucao);

if (isset($_GET["gravar"]))
{
    echo $clsl->gravar();   
}
else if (isset($_GET["deletar"]))
{
    echo $clsl->deletar();
} else if (isset($_GET['listalocacao'])) {
    $resultados = $clsl->consultalocacao();
    if (is_array($resultados) && !empty($resultados)) {
        echo json_encode($resultados);
    } else {
        echo json_encode(["erro" => "Nenhuma locação encontrada."]);
    }
}