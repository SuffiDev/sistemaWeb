<?php
 //Verificação da sessão
 session_start();
 if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != 1 || $_SESSION['admin'] != 0){
   header("Location: login.php");
 }
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Mensagens</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
</head>
<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                <?php 
                    include ('menuAdmin.php');
                ?>                    
                </div>
            </div>
            <?php
                include('headerTopo.php');
            ?>
        </nav>

        <div id="page-wrapper">
        
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mensagens</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <?php 
                    include ('cabecalho.php');
                ?>
            </div>
            <!-- /.row -->
            <div class="row">

            <div class="panel panel-info">
                <div class="panel-heading">
                    Adicione novas mensagens para enviar aos Colaboradores!
                </div>
                <div class="panel-body">
                    <?php  
                        require("conexao.php");
                        $id_item = $_GET['id'];
                        $query = "SELECT * FROM tb_mensagem WHERE id = '".$id_item."'";                            
                        $result = mysqli_query($conn,$query);
                        $item = mysqli_fetch_assoc($result);

                        $colaboradores = "SELECT * FROM tb_usuario";                            
                        $resultColabs = mysqli_query($conn,$colaboradores);
                        $itemColaboradores = '';
                        $lidos = mysqli_query($conn,"SELECT id_usuario FROM tb_leitura WHERE id_mensagem = '".$item['id']."'");
                        $arrayLidos = [];
                        while($itemLido=mysqli_fetch_array($lidos)){
                            array_push($arrayLidos, $itemLido[0]);
                        }
                        while($itemColab=mysqli_fetch_array($resultColabs)){
                            if(in_array($itemColab['id'],$arrayLidos))
                                if($itemColab['tipo'] == 'admin')
                                    $itemColaboradores .= "<option value='".$itemColab['id']."' selected='selected'>".$itemColab['nome']." - Administrador</option>";
                                else
                                    $itemColaboradores .= "<option value='".$itemColab['id']."'  selected='selected'>".$itemColab['nome']." - Colaborador</option>";
                            else
                                if($itemColab['tipo'] == 'admin')
                                    $itemColaboradores .= "<option value='".$itemColab['id']."'>".$itemColab['nome']." - Administrador</option>";
                                else
                                    $itemColaboradores .= "<option value='".$itemColab['id']."'>".$itemColab['nome']." - Colaborador</option>";
                        }
                        echo'
                            <form class="" id="form_mensagem" action="edita_mensagem.php" method="POST"  enctype="multipart/form-data">
                                <input type="hidden" value="'.$item['id'].'" class="form-control" name="id" style="width:auto !important;" id="id">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" value="'.$item['titulo'].'" class="form-control" name="titulo" style="width:auto !important;" id="titulo" placeholder="Digite o nome do banner">
                                </div>
                                <div class="form-group">
                                    <label>Corpo</label>
                                    <textarea class="form-control" name="corpo" style="width:auto !important;" id="corpo" placeholder="Digite o site do banner">'.$item['corpo'].'</textarea> 
                                </div>
                                <div class="form-group">
                                    <label>Colaboradores</label>                                    
                                    <select multiple="" name="colaboradores[]" id="colaboradores" class="form-control">
                                        '.$itemColaboradores.'
                                    </select>
                                </div>
                                <div style="float:left;">
                                    <button type="button" id="btn_cadastra" class="btn btn-outline btn-success">Salvar Alterações</button>
                                    </div>
                                    <div style="float:right;">
                                    <button type="button" id="btn_volta" class="btn btn-outline btn-info" onclick="javascript:history.go(-1)">Voltar</button>
                                </div>
                            </form>';
                        ?>
                    </div>
            </div>
        </div>

    </div>
</body>

</html>

<script>
$('#btn_cadastra').click(function(){
    if($("#titulo").val() == "" || $('#corpo').val() == "" || $('#colaboradores').val() == ""){
        alert("Preencha todos os campos!");
    }else{
        $('#form_mensagem').submit();
    }
});
</script>