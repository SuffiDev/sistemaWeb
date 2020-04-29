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
                          <form class="" id="form_mensagem" action="cadastra_mensagem.php" method="POST"  enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Titulo</label>
                              <input type="text" class="form-control" name="titulo" style="width:auto !important;" id="titulo" placeholder="Titulo:">
                            </div>
                              <div class="form-group">
                                <label>Corpo da Mensagem</label>
                                <textarea type="text" class="form-control" name="corpo" style="width:auto !important;" id="corpo" placeholder="Corpo:" > </textarea>
                              </div>

                              <div class="form-group">
                                    <label>Colaboradores</label>                                    
                                    <select multiple="" name="colaboradores[]" id="colaboradores" class="form-control">
                                        <?php
                                            $colaboradores = "SELECT * FROM tb_usuario";
                                            $result = mysqli_query($conn,$colaboradores);
                                            while($item=mysqli_fetch_array($result)){
                                                if($item['tipo'] == 'admin')
                                                    echo "<option value='".$item['id']."'>".$item['nome']." - Administrador</option>";
                                                else
                                                    echo "<option value='".$item['id']."'>".$item['nome']." - Colaborador</option>";
                                            }
                                        ?>
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
    if($("#titulo").val() == "" || $('#corpo').val() == "" || $('#colaboradores').val() == ""){
        alert("Preencha todos os campos!");
    }else{
        $('#form_mensagem').submit();
    }
});
</script>