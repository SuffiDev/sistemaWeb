<?php
	require("conexao.php");
	$id_banner = $_GET['id'];
	$tabela = $_GET['tabela'];
	if($tabela == 'mensagem'){
		$query = "DELETE FROM tb_mensagem WHERE id= '".$id_banner."'";

		$result = mysqli_query($conn, $query);

		header("Location: listaMensagens.php");
	}
	elseif($tabela == 'usuario'){
		$query = "DELETE FROM tb_usuario WHERE id= '".$id_banner."'";

		$result = mysqli_query($conn, $query);

		header("Location: ListaFuncionarios.php");
	}
?>
