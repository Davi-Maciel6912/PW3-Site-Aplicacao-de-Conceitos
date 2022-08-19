<?php

    $idProduto = $_POST['txIdProduto'];
    $produto = $_POST['txProduto'];
    $idCategoria = $_POST['txIdCategoria'];
    $valor = $_POST['txValor'];  

    include ("conexao.php");
    
    if($idProduto>0){
    $stmt = $pdo->prepare("update tbProduto set 
                        produto='$produto'
                        ,idCategoria='$idCategoria'
                        ,valor='$valor'
                        where idProduto='$idProduto'");	

    }
    else{
        $stmt = $pdo->prepare("insert into tbproduto values(null,'$produto','$idCategoria','$valor');");	
    
    
    }
    $stmt ->execute();

    header("location:produto-exibir.php");

?>