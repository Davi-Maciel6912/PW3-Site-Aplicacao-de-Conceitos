<?php
	require_once("conexao.php");
	//TABELA PRODUTO
	$id="";
	$produto ="";
	$valor ="";
	$categoria ="";


	

		//TABELA PRODUTO-----------------------------------------------------------------------------------------------------------------------------------------------
		$stmt = $pdo -> prepare("select idProduto, produto, categoria, valor from tbProduto
									inner join tbCategoria ON tbProduto.idCategoria = tbCategoria.idCategoria");       
		$stmt ->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){
			$id .= $row['idProduto'] . " <br />";
			$produto .= $row['produto'] . "<br />";
			$categoria .= $row['categoria'] . "<br />";
			$valor .= $row['valor'] . "<br />";
		}	
		$stmt = $pdo->prepare("select COUNT(idProduto)from tbProduto");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);

		$stmt = $pdo->prepare("select SUM(valor)from tbProduto");
        $stmt->execute();
        $row1 = $stmt->fetch(PDO::FETCH_BOTH);


	

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

		<h2> Produtos </h2>	
		<table>
			<tr>
				<th>ID</th>
				<th>Produtos</th>
				<th>Categoria</th>
				<th>Valor</th>
			</tr>
			
			<tr>
				<td>$id</td>
				<td>$produto</td>
				<td>$categoria</td>
				<td>$valor</td>
			</tr>
		</table> <br>
		Total de Produtos: $row[0] <br>    
		Valor total dos produtos: $row1[0]



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
