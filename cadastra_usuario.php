<?php
    session_start();
	require("conexao.php");
	$nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $query = "INSERT INTO tb_usuario (nome,sobre_nome,usuario,senha,tipo) VALUES ('".$nome."','".$sobrenome."','".$usuario."','".$senha."','".$tipo."');";
    $result = mysqli_query($conn, $query);	
    header("Location: ListaFuncionarios.php");
?>
