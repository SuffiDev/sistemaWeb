<?php
session_start();
require("conexao.php");
$id = $_GET['id'];
$busca = "SELECT * FROM tb_mensagem WHERE id='".$id."';";
$result = mysqli_query($conn, $busca);
$item = mysqli_fetch_assoc($result);
$update = "UPDATE tb_leitura SET lido = '1' WHERE id_mensagem = '".$id."' AND id_usuario = '".$_SESSION['id']."';";
echo '<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">'.$item['titulo'].'</h4>
        </div>
        <div class="modal-body">
            '.$item['corpo'].'
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    </div>
</div>';

//após montar a visualização eu altero para lido
$result = mysqli_query($conn, $update);
?>
