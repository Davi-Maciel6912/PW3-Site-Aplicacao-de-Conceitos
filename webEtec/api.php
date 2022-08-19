<?php

include("menu.php");
include("conexao.php");

    $Cep = $_POST['txCep'];
    $logradouro = ['txLog'];
    $bairro = ['txBairro'];
    $localidade = ['txLocal'];
    $uf = ['txUf'];

    $url = "https://viacep.com.br/ws/$Cep/json/";
    $json = file_get_contents($url);    
    $data = json_decode($json);
    // echo $data->cep . "<br />";
    echo $data->logradouro . "<br />";
    echo $data->bairro . "<br />";
    echo $data->localidade . "<br />";
    echo $data->uf . "<br />";


// header("location:consulta-cep.php");

?>

<?php include("rodape.php"); ?>