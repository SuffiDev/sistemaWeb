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
    <script src="js/maskInput.js"></script>
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
                    Altere os dados dos Funcionarios
                </div>
                <div class="panel-body">
                    <?php  
                        require("conexao.php");
                        $id_item = $_GET['id'];
                        $query = "SELECT * FROM tb_usuario WHERE id = '".$id_item."'";                            
                        $result = mysqli_query($conn,$query);
                        $opcoes = '';
                        $item = mysqli_fetch_assoc($result);
                        if($item['tipo'] == 'admin')
                            $opcoes .= '<option value="admin">Administrador</option> <option value="colaborador">Colaborador</option>';
                        else
                            $opcoes .= '<option value="colaborador">Colaborador</option> <option value="admin">Administrador</option>';
                        echo'
                                <form class="" id="form_mensagem" action="edita_funcionario.php" method="POST"  enctype="multipart/form-data">
                                    <input type="hidden" value="'.$item['id'].'" class="form-control" name="id" style="width:auto !important;" id="id">
                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" value="'.$item['nome'].'" class="form-control" name="nome" style="width:auto !important;" id="nome" placeholder="Digite o Nome">
                                    </div>
                                    <div class="form-group">
                                        <label>Sobrenome</label>
                                        <input type="text" value="'.$item['sobre_nome'].'" class="form-control" name="sobrenome" style="width:auto !important;" id="sobrenome" placeholder="Digite o Sobrenome">
                                    </div>
                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" value="'.$item['usuario'].'" class="form-control" name="usuario" style="width:auto !important;" id="usuario" placeholder="Digite o CPF">
                                    </div>
                                    <div class="form-group">
                                        <label>Senha</label>
                                        <input type="text" value="'.$item['senha'].'" class="form-control" name="senha" style="width:auto !important;" id="senha" placeholder="Digite a Senha">
                                    </div>
                                    <div class="form-group">
                                        <label>Tipo de usuario</label>
                                        <select class="form-control" name="tipo" id="tipo" style="width:auto !important;">
                                        '.$opcoes.'
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
    if($("#nome").val() == "" || $('#sobrenome').val() == "" || $('#usuario').val() == "" || $('#senha').val() == "" || $('#tipo').val() == ""){
        alert("Preencha todos os campos!");
    }else{
        $('#form_mensagem').submit();
    }
});
$(document).ready(function(){
    $('#usuario').mask('000.000.000-00')
})
</script>