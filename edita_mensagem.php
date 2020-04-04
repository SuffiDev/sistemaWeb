<?php
    session_start();
	require("conexao.php");
	$dataAgora = date("Y-m-d H:i:s");
	$titulo = $_POST['titulo'];
    $corpo = $_POST['corpo'];
    $id = $_SESSION['id'];
    $query = "UPDATE tb_mensagem SET titulo = '".$titulo."', corpo = '".$corpo."', data_cadastro = '".$dataAgora."' WHERE id= '".$_POST['id']."';";
    $result = mysqli_query($conn, $query);	    
    $idMensagem = $_POST['id'];
    $colaboradores = $_POST['colaboradores'];
    mysqli_query($conn, "DELETE FROM tb_leitura WHERE id_mensagem = '".$idMensagem."'");
    foreach ($colaboradores as $item){
        $query = "INSERT INTO tb_leitura(id_mensagem,id_usuario, lido) VALUES ('".$idMensagem."','".$item."','0')";
        mysqli_query($conn, $query);
    }
    header("Location: listaMensagens.php");
?>
