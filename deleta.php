<?php
	require("conexao.php");
	$id = $_GET['id'];
	$tabela = $_GET['tabela'];
	if($tabela == 'mensagem'){
		$query = "DELETE FROM tb_mensagem WHERE id= '".$id."'";

		$result = mysqli_query($conn, $query);
		$query = "DELETE FROM tb_leitura WHERE id_mensagem= '".$id."'";

		$result = mysqli_query($conn, $query);

		header("Location: listaMensagens.php");
	}
	elseif($tabela == 'usuario'){
		$query = "DELETE FROM tb_usuario WHERE id= '".$id."'";

		$result = mysqli_query($conn, $query);

		header("Location: ListaFuncionarios.php");
	}
	elseif($tabela == 'holerite'){
		$query = "DELETE FROM tb_holerite WHERE id= '".$id."'";
		$busca = "SELECT * FROM tb_holerite WHERE id = '".$id."'";
		$resultBusca = mysqli_query($conn, $busca);
		$item = mysqli_fetch_assoc($resultBusca);
		unlink($item['caminho_documento']);
		$result = mysqli_query($conn, $query);

		header("Location: ListaHolerites.php");
	}
	elseif($tabela == 'documento'){
		$query = "DELETE FROM tb_documento WHERE id= '".$id."'";
		$busca = "SELECT * FROM tb_documento WHERE id = '".$id."'";
		$resultBusca = mysqli_query($conn, $busca);
		$item = mysqli_fetch_assoc($resultBusca);
		unlink($item['caminho_arquivo']);

		$result = mysqli_query($conn, $query);

		header("Location: ListaDocumentos.php");
	}
?>
