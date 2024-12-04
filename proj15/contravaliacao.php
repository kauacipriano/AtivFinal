<?php
include_once "clsavaliacao.php"; 
$clsa = new clsavaliacao(); 

$id_avaliacao           = isset($_GET["id_avaliacao"]) ? $_GET["id_avaliacao"] : null;
$id_cliente             = isset($_GET["id_cliente"]) ? $_GET["id_cliente"] : null;
$id_filme               = isset($_GET["id_filme"]) ? $_GET["id_filme"] : null;
$data_avaliacao         = isset($_GET["data_avaliacao"]) ? $_GET["data_avaliacao"] : null;
$nota_avaliacao         = isset($_GET["nota_avaliacao"]) ? $_GET["nota_avaliacao"] : null;
$comentario_avaliacao   = isset($_GET["comentario_avaliacao"]) ? $_GET["comentario_avaliacao"] : null;



$clsa -> setid_avaliacao ($id_avaliacao);
$clsa -> setid_cliente ($id_cliente);
$clsa -> setid_filme ($id_filme);
$clsa -> setdata_avaliacao ($data_avaliacao);
$clsa -> setnota_avaliacao ($nota_avaliacao);
$clsa -> setcomentario_avaliacao ($comentario_avaliacao);

   
if (isset($_GET["gravar"]))
{
    echo $clsa->gravar();   
}
else if (isset($_GET["deletar"]))
{
    echo $clsa->deletar();
}else if (isset($_GET['listaavaliacao'])) {
    $resultados = $clsa->consultaavaliacao();
    if (is_array($resultados) && !empty($resultados)) {
        echo json_encode($resultados);
    } else {
        echo json_encode(["erro" => "Nenhuma avaliação encontrado."]);
    }
}

