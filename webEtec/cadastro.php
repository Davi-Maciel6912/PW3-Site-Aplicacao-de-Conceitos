<?php
include('cabecalho.php');
include("conexao.php");


?>
<div class="container1">
    <form method="post" action="inserir-cadastro.php" class="formulario">

        <br>


        <h4>Cadastro</h4>

        <div>
            <label> Nome </label>
            <input class="campo2" type="text" id="txNome" name="txNome" placeholder="Nome">
        </div>

        <div>
            <label> Email </label>
            <input class="campo2" type="text" id="txEmail" name="txEmail" placeholder="Email">
        </div>

        <div>
            <label> Senha </label>
            <input class="campo2" type="password" id="txPass" name="txPass" placeholder="Senha">
        </div>

        <div>
            <label> Confirmar Senha </label>
            <input class="campo2" type="password" id="txPass2" placeholder="Confirmar Senha">
        </div>

        <script>

            let inputPass = document.querySelector('#txPass');
            let inputConfirmPass = document.querySelector('#txPass2');

            inputConfirmPass.addEventListener('focusout', () => {
                if (inputPass.value !== inputConfirmPass.value) {
                    alert('As senhas não coincidem');
                }
            })

        </script>

        <br>

        <input type="submit" value="Cadastrar" class="btn" />


        <br>
        <br>


        <br>

    </form>

</div>