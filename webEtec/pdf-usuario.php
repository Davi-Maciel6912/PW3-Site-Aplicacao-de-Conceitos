<?php
	require_once("conexao.php");

    $id ="";
    $nome ="";
    $email ="";


		//TABELA CATEGORIA----------------------------------------------------------------------------------------------------------------------------------------------
		$stmt = $pdo -> prepare("select * from tbusuario");       
		$stmt ->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){
			$id .= $row['idUsuario'] . " <br />";
			$nome .= $row['nomeUsuario'] . "<br />";
            $email .= $row['emailUsuario'] . "<br />";
		}	

		$stmt = $pdo->prepare("select COUNT(idUsuario)from tbusuario");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);


		

	// include autoloader
	require_once("dompdf/autoload.inc.php");
	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;
	
	//Criando a Instancia
	$dompdf = new DOMPDF();

	// Carrega seu HTML (Conteúdo)
	$dompdf->load_html(
		"
		<h1 style='background:#59b4e2;'> Last Piece </h1>			
		
		<h2> Usuarios </h2>	
		<table>
			<tr>
				<th>ID</th>
				<th>Usuarios</th>
                <th>Email</th>
			</tr>
			
			<tr>
				<td>$id</td>
				<td>$nome</td>
                <td>$email</td>
			</tr>
            <br>
		</table> 
		Total de Usuários: $row[0] 

		"
	);
	
	$dompdf->setPaper('A4', 'portrait'); //landscape	
		
	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"categorias.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);