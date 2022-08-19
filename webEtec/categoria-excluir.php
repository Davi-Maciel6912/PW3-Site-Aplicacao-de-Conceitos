<?php
    $id = $_GET['id'];
    
    include("conexao.php");

    $stmt = $pdo->prepare("delete from tbcategoria where idCategoria='$id'");	
	$stmt ->execute();


    header("location:categoria-exibir.php");
?>