<?php

    include("conexao.php");

    $stmt = $pdo->prepare("select * from tbProduto");	
    $stmt ->execute();

    $data = array();
    while($row = $stmt ->fetch(PDO::FETCH_ASSOC)){        
        $data[] = $row;                   					
    }	

    echo json_encode($data);
?>