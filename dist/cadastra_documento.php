<?php
    session_start();
	require("conexao.php");
    $dataAgora = date("Y-m-d H:i:s");
    $nome = $_POST['documento'];

    //Salvando o arquivo na pasta de destino

    $info = pathinfo($_FILES['arquivo']['name']);
    $ext = $info['extension']; // get the extension of the file
    $replace_text = preg_replace('/[ -_]/','',$nome);
    $target = "documentos/".$replace_text.".".$ext; 
    move_uploaded_file( $_FILES['arquivo']['tmp_name'], $target);

    //Adicionando no banco
    $query = "INSERT INTO tb_documento (nome, caminho_arquivo, data_cadastro) VALUES ('".$nome."','".$target."','".$dataAgora."');";
    $result = mysqli_query($conn, $query);	
    $idMensagem = mysqli_insert_id($conn);
    //header("Location: ListaHolerites.php");
    
?>
