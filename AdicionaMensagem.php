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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="js/maskInput.js"></script>    
    <script src="js/jsForm.js"></script>    

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
</head>
<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- /.navbar-header -->


            <?php
                include('headerTopo.php');
            ?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <?php 
                        include ('menuAdmin.php');
                    ?>   
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
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
                              <input type="text" class="form-control" name="titulo" style="width:500px !important;" id="titulo" placeholder="Titulo:">
                            </div>
                              <div class="form-group">
                                <label>Corpo da Mensagem</label>
                                <textarea type="text" class="form-control" name="corpo" style="height: 200px !important" id="corpo" placeholder="Corpo:" > </textarea>
                              </div>

                              <div class="form-group">
                                    <label>Colaboradores</label>                                    
                                    <select multiple="" name="colaboradores[]" style="height: 300px !important" id="colaboradores" class="form-control">
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