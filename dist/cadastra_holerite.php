<?php
    session_start();
	require("conexao.php");
    $dataAgora = date("Y-m-d H:i:s");
    $ano_ref = $_POST['ano'];
    $mes_ref = $_POST['mes_ref'];
    $id_colab = $_POST['colaborador'];

    //Salvando o arquivo na pasta de destino
    $id_item = $_GET['id'];
    $query = "SELECT * FROM tb_usuario WHERE id = '".$id_colab."'";                            
    $result = mysqli_query($conn,$query);
    $item = mysqli_fetch_assoc($result);

    $info = pathinfo($_FILES['arquivo']['name']);
    $nome_arq = $mes_ref . $ano_ref . $item['usuario'];
    $ext = $info['extension']; //pegando a extensão do arquivo
    $target = "holerites/".$item['usuario']."/".$nome_arq.".".$ext; 
    //Cria o diretorio caso não exista
    if (!file_exists("holerites/".$item['usuario'])) {
        mkdir("holerites/".$item['usuario'], 0777, true);
    }
    move_uploaded_file( $_FILES['arquivo']['tmp_name'], $target);

    //Adicionando no banco
    $query = "INSERT INTO tb_holerite (id_usuario,data_cadastro,caminho_documento,mes_referencia,ano_referencia) VALUES ('".$id_colab."','".$dataAgora."','".$target."','".$mes_ref."','".$ano_ref."');";
    $result = mysqli_query($conn, $query);	
    $idMensagem = mysqli_insert_id($conn);
    //header("Location: ListaHolerites.php");
    
?>
