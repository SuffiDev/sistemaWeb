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
    <title>Funcionarios</title>
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
                    <h1 class="page-header">Funcionarios</h1>
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
                            Adicione novos Colaboradores!
                        </div>
                        <div class="panel-body">
                            <form class="" id="form_funcionario" action="cadastra_usuario.php" method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome" style="width:auto !important;" id="nome" placeholder="Nome:">
                            </div>
                            <div class="form-group">
                                <label>Sobrenome</label>
                                <input type="text" class="form-control" name="sobrenome" style="width:auto !important;" id="sobrenome" placeholder="Sobrenome:">
                            </div>
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="usuario" style="width:auto !important;" id="usuario" placeholder="Usuario:">
                            </div>
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="text" class="form-control" name="senha" style="width:auto !important;" id="senha" placeholder="Senha:">
                            </div>
                            <div class="form-group">
                                <label>Tipo de Usuario</label>
                                <select class="form-control"  name="tipo" style="width:auto !important;" id="tipo" >
                                    <option value="admin">Administrador</option>
                                    <option value="colaborador">Colaborador</option>
                                </select>
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
    if($("#nome").val() == "" || $('#sobrenome').val() == "" || $('#usuario').val() == "" || $('#senha').val() == "" || $('#tipo').val() == ""){
        alert("Preencha todos os campos!");
    }else{
        $('#form_funcionario').submit();
    }
});
</script>