<?php
    session_start();
	require("conexao.php");
	$nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $usuario = preg_replace('/[ .-]/','', $_POST['usuario']);
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $query = "INSERT INTO tb_usuario (nome,sobre_nome,usuario,senha,tipo,primeiro_login) VALUES ('".$nome."','".$sobrenome."','".$usuario."','".$senha."','".$tipo."','0');";
    $result = mysqli_query($conn, $query);	
    header("Location: ListaFuncionarios.php");
?>
