<?php

    $idProduto = $_POST['txIdProduto'];
    $produto = $_POST['txProduto'];
    $idCategoria = $_POST['txIdCategoria'];
    $valor = $_POST['txValor'];    

    include("conexao.php");

    $stmt = $pdo->prepare("update tbProduto set 
                            produto='$produto'
                            ,idCategoria='$idCategoria'
                            ,valor='$valor'
                            where idProduto='$idProduto'");	
	$stmt ->execute();

    header("location:produto-exibir.php");
?>