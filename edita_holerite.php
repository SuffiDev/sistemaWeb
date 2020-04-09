<?php
    session_start();
	require("conexao.php");
    $dataAgora = date("Y-m-d H:i:s");
    $ano_ref = $_POST['ano'];
    $mes_ref = $_POST['mes_ref'];
    $id_colab = $_POST['colaborador'];
    $id_edit = $_POST['id'];

    //Salvando o arquivo na pasta de destino
    $id_item = $_GET['id'];
    $query = "SELECT * FROM tb_usuario WHERE id = '".$id_colab."'";                            
    $result = mysqli_query($conn,$query);
    $item = mysqli_fetch_assoc($result);

    $info = pathinfo($_FILES['arquivo']['name']);
    if($info['extension'] != null){
        $nome_arq = $mes_ref . $ano_ref . $item['usuario'];
        $ext = $info['extension']; //pegando a extensão do arquivo
        //Caso não exista o arquivo, eu crio ele 
        if (!file_exists("holerites/".$item['usuario'])) {
            mkdir("holerites/".$item['usuario'], 0777, true);
        }
        $target = "holerites/".$item['usuario']."/".$nome_arq.".".$ext; 
        move_uploaded_file( $_FILES['arquivo']['tmp_name'], $target);
    }

    //Adicionando no banco
    $query = "UPDATE tb_holerite SET id_usuario = '".$id_colab."', caminho_documento = '".$target."', mes_referencia = '".$mes_ref."', ano_referencia = '".$ano_ref."' WHERE id = '".$id_edit."'";
    $result = mysqli_query($conn, $query);	
    $idMensagem = mysqli_insert_id($conn);
    //header("Location: ListaHolerites.php");
    
?>
