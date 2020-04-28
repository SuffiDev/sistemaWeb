<?php
 //Verificação da sessão
 session_start();
 if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE || $_SESSION['ADMIN'] == TRUE){
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
    <title>Documentos</title>
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
                    <h1 class="page-header">Documentos</h1>
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
                            Relize o cadastro de Documentos padrão para os Colaboradores
                        </div>
                        <div class="panel-body">
                            <div id="detalhes"> </div>
                            <form id="form_funcionario" action="cadastra_documento.php" method="POST"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" class="form-control" name="documento" style="width:auto !important;" id="documento" placeholder="Titulo do Documento">                                    
                                </div>
                                <div class="form-group">
                                    <label>Colaborador</label>
                                    <select class="form-control" multiple="multiple"  name="colaborador[]" style="width:auto !important;" id="colaborador" >                                    
                                    <?php
                                        $colaboradores = "SELECT * FROM tb_usuario where tipo= 'colaborador'";
                                        $result = mysqli_query($conn,$colaboradores);
                                        while($item=mysqli_fetch_array($result)){
                                            echo "<option value='".$item['id']."'>".$item['nome']."</option>";
                                        }
                                    ?>
                                    </select>
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
                        </div>
            </div>
        </div>

    </div>
</body>

</html>

<script>
$('#btn_cadastra').click(function(){
    if($("#titulo").val() == "" || $("#arquivo").val() == ''){
        alert("Preencha todos os campos!");
    }else{
        let nome_arquivo = $('#arquivo').val();
        let nome_splitado = nome_arquivo.split('.')[1];

        if (nome_splitado == 'pdf' || nome_splitado == 'doc' || nome_splitado == 'docx')
            $('form').submit();    
        else
            alert("Selecione um documento PDF ou World válido!")
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