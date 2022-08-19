<?php
include("cabecalho.php");
include("menu.php");
include("conexao.php");


?>
  <h4 class="title"> Inserir Produtos </h4>


<br>
    <section>
        <center>

            <form method="post" action="decisao.php" onsubmit="return validarTudo()">
                <!-- <form method="post" action="produto-inserir.php"> -->

                <div>

                    <input type="hidden" placeholder="idProduto" name="txIdProduto" value="<?php echo @$_GET['idProduto']; ?>" />

                    <input class="campo" type="text" required placeholder="Produto" name="txProduto" id="txProduto" value="<?php echo @$_GET['produto']; ?>" />

                    <input class="campo" type="text" placeholder="Valor" name="txValor"  id="txValor" value="<?php echo @$_GET['valor']; ?>" />

                    <?php
                    $stmtCat = $pdo->prepare("select * from tbcategoria");
                    $stmtCat->execute();

                    ?>
                    

                        <?php
                        $cat = @$_GET['categoria'];
                        ?>

                        <select name="txIdCategoria" class="select">
                            <option value='0' class=""> Categoria </option>
                            <?php
                            while ($rowCat = $stmtCat->fetch(PDO::FETCH_BOTH)) {
                                if ($cat == $rowCat[1]) {
                                    $sel = "selected";
                                } else {
                                    $sel = "";
                                }
                                echo "<option value='$rowCat[0]' $sel> $rowCat[1] </option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Salvar" class="btn" />
                </div>



                    
                </div>
            </form>
        </center>
    </section>


    <section>
        <div class="container"> 
            <table class="table table-borderless">

                <!-- <th>Id</th> -->
                <th> Produto</th>
                <th>Valor</th>
                <th>Categoria</th>
                <th> &nbsp; </th>
                <th> &nbsp; </th>


                <br>
                <h4 class="title"> Exibir Produtos </h4>

                <?php

               

                $stmt = $pdo->prepare("select p.idProduto, p.produto, p.valor, c.categoria 
                                        from tbproduto p
                                        inner join tbcategoria c
                                        on p.idCategoria = c.idCategoria");

                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {


                    echo "<tr>";
                    // echo "<td> $row[0] </td>";
                    echo "<td> $row[1] </td>";
                    echo "<td> $row[2] </td>";
                    echo "<td> $row[3] </td>";

                    echo "<td>";
                    echo "<a href='produto-excluir.php?id=$row[0]'> Excluir </a>";
                    echo "</td>";

                    echo "<td>";
                    echo "<a href='?idProduto=$row[0]&produto=$row[1]&valor=$row[2]&categoria=$row[3]'> Alterar </a>";
                    echo "</td>";
                }
                ?>
                
        </div>
        
    </section>

<?php
    include("conexao.php");

            $stmt = $pdo->prepare("select COUNT(idProduto)from tbProduto");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_BOTH);?>

            <p class="pro1"><b> <?php echo "Total de produtos: $row[0]";?> </b></p>


            <?php 
            $stmt = $pdo->prepare("select SUM(valor)from tbProduto");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_BOTH);?>

            <p class="pro2"><b> <?php echo "Valor total dos produtos: $row[0]";?> </b></p>



<?php include("rodape.php"); ?>

<script>
    function validarProduto(){
        var produto = document.getElementById("txProduto").value; 

        if(produto.length>3){
                
            return true;
        }
        else{
            
            return false;
        }
    }

    function validarValor(){
        var valor = document.getElementById("txValor").value; 

        if(parseFloat(valor) <= 0){
            return false;
        }
        else{
            return true;
        }

    }

    function validarTudo(){
        if(validarProduto() && validarValor()){
            alert("Dados corretos");    
            return true;
        }
        else{
            alert("Dados incorretos");
            return false;
        }
    }
</script>

<a href="pdf-produto.php"><button class="btn">CPF Produtos</button></a>



    

