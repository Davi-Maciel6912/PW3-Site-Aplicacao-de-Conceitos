<?php

 
    $nome = $_POST['txNome'];
    $email = $_POST['txEmail'];
    $pass = $_POST['txPass'];

    //echo " $produto $idCategoria $valor";

    include("conexao.php");

    $stmt = $pdo->prepare("insert into tbusuario values(null, '$nome', '$email', '$pass');");	
	$stmt ->execute();

    


    header("location:index.php");