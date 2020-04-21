<?php
    session_start();
	require("conexao.php");
	$nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $usuario = preg_replace('/[ .-]/','', $_POST['usuario']);
    $senha = $_POST['senha'];
    $id = $_SESSION['id'];
    $query = "UPDATE tb_usuario SET nome = '".$nome."', sobre_nome = '".$sobrenome."', usuario = '".$usuario."', senha = '".$senha."', tipo = '".$tipo."' WHERE id= '".$_POST['id']."';";
    $result = mysqli_query($conn, $query);	    
    header("Location: MeuPerfil.php?retorno=ok");
?>
