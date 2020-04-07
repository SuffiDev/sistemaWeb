<?php
    session_start();
	require("conexao.php");
    $nome = $_POST['documento'];
    $id = $_POST['id'];

    //Salvando o arquivo na pasta de destino

    $info = pathinfo($_FILES['arquivo']['name']);
    if($info['extension'] != null){
        $ext = $info['extension']; // get the extension of the file
        $replace_text = preg_replace('/[ -_]/','',$nome);
        $target = "documentos/".$replace_text.".".$ext; 
        move_uploaded_file( $_FILES['arquivo']['tmp_name'], $target);
    }

    //Adicionando no banco
    $query = "UPDATE f_documento SET nome = '".$nome."', caminho_arquivo = '".$target."','".$dataAgora."' WHERE id = '".$id."';";
    $result = mysqli_query($conn, $query);	
    $idMensagem = mysqli_insert_id($conn);
    //header("Location: ListaHolerites.php");
    
?>
