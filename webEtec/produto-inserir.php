<?php


    $produto = $_POST['txProduto'];
    $idCategoria = $_POST['txIdCategoria'];
    $valor = $_POST['txValor'];

    //echo " $produto $idCategoria $valor";

    include("conexao.php");

    // $stmt = $pdo->prepare("insert into tbproduto values(null,'$produto','$valor','$idCategoria');");	
	// $stmt ->execute();

    header("location:produto-exibir.php");

?>