<?php

    include("conexao.php");

    $email = $_POST['txEmail'];
    $pass = $_POST['txPass'];

    $stmt = $pdo->prepare("select count(*) from tbusuario
                             where emailUsuario='$email' and senhaUsuario='$pass'");
    $stmt ->execute();
    $varRes = $stmt->fetchColumn();

    if($varRes > 0){
        header("location:dashboard.php");
    }
    else{ 
        echo 'alert("Email ou Senha Incorretos");';
    }

    

    
?>