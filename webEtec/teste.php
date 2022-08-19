<!-- <?php
include("conexao.php");
 $query = $pdo->prepare("select count(y.idProduto), x.categoria from tbProduto y 
            inner join tbCategoria x 
            on y.idCategoria = x.idCategoria 
            group by idProduto;
            ");
            $query->execute();
            ?>

          <?php  ($rows = $query->fetch(PDO::FETCH_BOTH))?>
          <?php
            for($i=1;$i<=$rows[0];$i++){
                echo"['$rows[1]', $rows[0]]";
              }
              ?> -->
                <?php

               

$stmt = $pdo->prepare("select count(y.idProduto), x.categoria from tbProduto y 
inner join tbCategoria x 
on y.idCategoria = x.idCategoria 
group by idProduto;
");

$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {


    echo "<tr>";
    echo "<td> $row[0] </td>";
    echo "<td> $row[1] </td>";
    

    
}
?>


<?php
        while ($rows = $query->fetch(PDO::FETCH_BOTH)) {?>

          [<?php echo $rows[1] ?>, <?php echo $rows[0] ?>],
        
      <?php }
        
        ?>


<?php
            for($i=1;$i<= $query->fetch(PDO::FETCH_BOTH);$i++){
                echo"['$rows[1]', $rows[0]],";
              }
              ?> 