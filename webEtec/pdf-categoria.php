<?php
	require_once("conexao.php");
	// TABELA CATEGORIA
	$id ="";
	$categoria ="";

	




		//TABELA CATEGORIA----------------------------------------------------------------------------------------------------------------------------------------------
		$stmt = $pdo -> prepare("select * from tbCategoria");       
		$stmt ->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){
			$id .= $row['idCategoria'] . " <br />";
			$categoria .= $row['categoria'] . "<br />";
		}	

		$stmt = $pdo->prepare("select COUNT(idCategoria)from tbCategoria");
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
		
		<h2> Categorias </h2>	
		<table>
			<tr>
				<th>ID</th>
				<th>Categorias</th>
			</tr>
			
			<tr>
				<td>$id</td>
				<td>$categoria</td>
			</tr>
		</table> 
		Total de Categorias: $row[0] 

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