<?php
include("cabecalho.php");
include("menu.php");
include("conexao.php");


?>
<h4 class="title"> Inserir Categoria </h4>


<br>
<section>
    <center>

        <form method="post" action="categoria-inserir.php" onsubmit="return validarTudo()">
            <!-- <form method="post" action="produto-inserir.php"> -->

            <div>
                <input type="hidden" placeholder="idCategoria" name="txIdCategoria" value="<?php echo @$_GET['idCategoria']; ?>" />

                <input class="campo" type="text" placeholder="Categoria" name="txCategoria" id="txCategoria" value="<?php echo @$_GET['categoria']; ?>" />

                <?php
                $stmtCat = $pdo->prepare("select * from tbcategoria");
                $stmtCat->execute();

                ?>

                <input type="submit" value="Salvar" class="btn" />

            </div>
        </form>
    </center>
</section>


<section>
    <div class="container">
        <table class="table table-borderless">

            <!-- <th>Id</th> -->

            <th> &nbsp; </th>
            <th> &nbsp; </th>


            <br>


            <h4 class="title2"> Exibir Categoria </h4>
            <?php

            $stmt = $pdo->prepare("select idCategoria, categoria from tbcategoria");

            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {


                echo "<tr>";
                // echo "<td> $row[0] </td>";
                echo "<td> <b> $row[1] </b></td>";

                echo "<td>";
                echo "<a href='categoria-excluir.php?id=$row[0]'> Excluir </a>";
                echo "</td>";


                echo "</tr>";
            }
            ?>
    </div>
</section>
<?php
include("conexao.php");

$stmt = $pdo->prepare("select COUNT(idCategoria)from tbCategoria");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
?>
<p class="cate"><b><?php echo "Total de Categoria: $row[0] "; ?> </b></p>

<?php include("rodape.php"); ?>

<script>
    function validarCategoria() {
        var produto = document.getElementById("txCategoria").value;

        if (produto.length > 3) {
            alert("Dados corretos");
            return true;
        } else {
            alert("Dados incorretos");
            return false;
        }
    }
</script>


<a href="pdf-categoria.php"><button class="btn">CPF Categoria</button> </a>