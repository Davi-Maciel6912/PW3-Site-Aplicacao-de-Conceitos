<?php
include("cabecalho.php");
include("menu.php");
include("conexao.php");
if(isset($Cep)){
$Cep = $_POST['txCep'];
        // $logradouro = ['txLog'];
        // $bairro = ['txBairro'];
        // $localidade = ['txLocal'];
        // $uf = ['txUf'];

        $url = "https://viacep.com.br/ws/$Cep/json/";
        $json = file_get_contents($url);    
        $data = json_decode($json);
        // echo $data->cep . "<br />";
        // echo $data->logradouro . "<br />";
        // echo $data->bairro . "<br />";
        // echo $data->localidade . "<br />";
        // echo $data->uf . "<br />";
}
?>
<?php
if(isset($Cep)){
?>
<h4 class="title"> Consultar </h4>
<div class="container">
    <form method="post" >


        <div>

            <input class="campo" type="text" placeholder="CEP" name="txCep">

            <input type="submit" class="btn" value="Consultar" />

        </div>


        <div>
            <input class="campo1" type="text" placeholder="Logradouro" name="txLog" value="<?php echo $data->logradouro ?>">
            <input class="campo1" type="text" placeholder="Bairro" name="txBairro" value="<?php  echo $data->bairro ?>">
        </div>

        <div>
            <input class="campo1" type="text" placeholder="Localidade" name="txLocal" value="<?php echo $data->localidade ?>">
            <input class="campo1" type="text" placeholder="UF" name="txUf" value="<?php echo $data->uf ?>">
        </div>
    </form>

</div>
<?php }else{?>

    <h4 class="title"> Consultar </h4>
<div class="container">
    <form method="post" >


        <div>

            <input class="campo" type="text" placeholder="CEP" name="txCep">

            <input type="submit" class="btn" value="Consultar" />

        </div>


        <div>
            <input class="campo1" type="text" placeholder="Logradouro" name="txLog" >
            <input class="campo1" type="text" placeholder="Bairro" name="txBairro" >
        </div>

        <div>
            <input class="campo1" type="text" placeholder="Localidade" name="txLocal">
            <input class="campo1" type="text" placeholder="UF" name="txUf">
        </div>
    </form>
<?php }?>
