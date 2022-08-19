<?php
include('cabecalho.php');
include("conexao.php");


?>




<div class="container1">
  <form method="post" action="valida-login.php" class="formulario" >

    <br>


    <h4>Login</h4>

    <div>
      <label> Email </label>
      <input class="campo2" type="text" name="txEmail" id="txEmail" placeholder="Email">
    </div>

    <div>
      <label> Senha </label>
      <input class="campo2" type="password" name="txPass" id="txPass" placeholder="Senha">
    </div>

    <br>

    <input type="submit" value="Entrar" class="btn" />


    <br>
    <br>

    <p>Não tem cadastro? Clique <a href="cadastro.php" class="link"> aqui </a></p>

    <br>

  </form>

</div>




</body>

</html>



<?php include("rodape.php")  ?>