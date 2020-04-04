<?php
    session_start();
	require("conexao.php");
	$dataAgora = date("Y-m-d H:i:s");
	$titulo = $_POST['titulo'];
    $corpo = $_POST['corpo'];
    $id = $_SESSION['id'];
    $query = "INSERT INTO tb_mensagem (titulo,corpo,data_cadastro,id_admin) VALUES ('".$titulo."','".$corpo."','".$dataAgora."','".$id."');";
    $result = mysqli_query($conn, $query);	
    $idMensagem = mysqli_insert_id($conn);
    //Após salvar a mensagem eu vou distribui-la para os colaboradores
    $colaboradores = $_POST['colaboradores'];
    foreach ($colaboradores as $item){
        $query = "INSERT INTO tb_leitura(id_mensagem,id_usuario, lido) VALUES ('".$idMensagem."','".$item."','0')";
        mysqli_query($conn, $query);
    }
    header("Location: listaMensagens.php");
?>
