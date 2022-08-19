<?php
include("cabecalho.php");
include("menu.php");
include("conexao.php");


?>

<section>
        <div class="container"> 
            <table class="table table-borderless">

                <!-- <th>Id</th> -->
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>


                <br>
                <h4 class="title"> Exibir Usuários </h4>

                <?php

               

                $stmt = $pdo->prepare("select * from tbusuario");

                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {


                    echo "<tr>";
                    // echo "<td> $row[0] </td>";
                    echo "<td> $row[0] </td>";
                    echo "<td> $row[1] </td>";
                    echo "<td> $row[2] </td>";
                    echo "<td> $row[3] </td>";

                }
                ?>
                
        </div>
        
    </section>

<?php
    include("conexao.php");

            $stmt = $pdo->prepare("select COUNT(idUsuario)from tbusuario");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_BOTH);?>

            <p class="pro1"><b> <?php echo "Total de Usuários: $row[0]";?> </b></p>


<?php include("rodape.php"); ?>


<a href="pdf-usuario.php"><button class="btn">CPF Usuário</button></a>