<?php
 //Verificação da sessão
 session_start();
 if((!isset($_SESSION["logado"])) || ($_SESSION['logado'] != 1) || ($_SESSION['admin'] != 1)){
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
    <script src="vendor/jquery/jsform.js"></script> 
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
                        $query = "SELECT * FROM tb_documento WHERE id = '".$id_item."'";                            
                        $result = mysqli_query($conn,$query);
                        $item = mysqli_fetch_assoc($result);
                        echo'
                        <div id="detalhes"> </div>
                        <form id="form_funcionario" action="cadastra_documento.php" method="POST"  enctype="multipart/form-data">
                            <input type="hidden" value="'.$item['id'].'" class="form-control" name="id" style="width:auto !important;" id="id">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" value="'.$item['nome'].'" class="form-control" name="documento" style="width:auto !important;" id="documento" placeholder="Titulo do Documento">                                    
                            </div>
                            <div class="form-group">
                                <label>Arquivo</label>
                                <input type="file" class="form-control" name="arquivo" style="width:auto !important;" id="arquivo" placeholder="Senha:">
                            </div>   
                            <div class="progress" style="width:25%">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>                             
                            <div style="float:left;">
                                <button type="button" id="btn_cadastra" class="btn btn-outline btn-success">Cadastrar</button>
                            </div>
                            <div style="float:right;">
                                <button type="button" id="btn_volta" class="btn btn-outline btn-primary" onclick="javascript:history.go(-1)">Voltar</button>
                            </div>
                        </form>
                    </div>';
                        ?>
                    </div>
            </div>
        </div>

    </div>
</body>

</html>

<script>
$('#btn_cadastra').click(function(){
    if($("#titulo").val() == ""){
        alert("Preencha todos os campos!");
    }else{
        $('form').submit();        
    }
});
$(function() {
    var bar = $('.progress-bar');
    $('form').ajaxForm({
        beforeSend: function() {
            let percentVal = '0%';
            bar.css('width',percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.css('width',percentVal);
            if(percentVal == '100%'){
                $('#detalhes').html('<div class="alert alert-success">Cadastrado com Sucesso! <a href="javascript:history.go(-1)" class="alert-link">Clique aqui para voltar</a>.<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>')
            }
        },
        complete: function(xhr) {
            //history.go(-1);
        }
    });
}); 
</script>