<?php
include_once "clscliente.php"; 
$clsc = new clscliente(); 


$id_cliente         = isset($_GET["id_cliente"]) ? $_GET["id_cliente"] : null;
$nome_cliente       = isset($_GET["nome_cliente"]) ? $_GET["nome_cliente"] : null;
$cpf_cliente        = isset($_GET["cpf_cliente"]) ? $_GET["cpf_cliente"] : null;
$data_nasc_cliente  = isset($_GET["data_nasc_cliente"]) ? $_GET["data_nasc_cliente"] : null;
$telefone_cliente   = isset($_GET["telefone_cliente"]) ? $_GET["telefone_cliente"] : null;
$email_cliente      = isset($_GET["email_cliente"]) ? $_GET["email_cliente"] : null;


$clsc->setid_cliente($id_cliente);
$clsc->setnome_cliente($nome_cliente);
$clsc->setcpf_cliente($cpf_cliente);
$clsc->setdata_nasc_cliente($data_nasc_cliente);
$clsc->settelefone_cliente($telefone_cliente);
$clsc->setemail_cliente($email_cliente);


if (isset($_GET["gravar"])) {
    echo $clsc->gravar(); 
} else if (isset($_GET["deletar"])) {
    echo $clsc->deletar(); 
}else if (isset($_GET['listacliente'])) {
    $resultados = $clsc->consultacliente();
    if (is_array($resultados) && !empty($resultados)) {
        echo json_encode($resultados);
    } else {
        echo json_encode(["erro" => "Nenhum cliente encontrado."]);
    }
}
