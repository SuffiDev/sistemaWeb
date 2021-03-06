<?php
 //Verificação da sessão
 session_start();
 if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != 1){
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
    <title>Perfil</title>
    <!-- Core CSS - Include with every page -->
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
                <?php echo '<a class="navbar-brand">Olá, '.$_SESSION['nome'].' </a>' ?>
            </div>
            <!-- /.navbar-header -->


            <?php
                include('headerTopo.php');
            ?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <?php 
                        if ($_SESSION['admin'] != 1)
                            include ('menuColaborador.php');
                        else
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
                    <h1 class="page-header">Meu Perfil</h1>
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
                    Altere seus dados pessoais
                </div>
                <div class="panel-body">
                    <?php  
                        if($_GET['retorno'] == 'ok'){
                            echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Seus dados foram atualizados com sucesso!
                            </div>';
                        }
                        require("conexao.php");
                        session_start();
                        $id_item = $_GET['id'];
                        $query = "SELECT * FROM tb_usuario WHERE id = '".$_SESSION['id']."'";                            
                        $result = mysqli_query($conn,$query);
                        $item = mysqli_fetch_assoc($result);
                        echo'
                                <form class="" id="form_mensagem" action="edita_perfil.php" method="POST"  enctype="multipart/form-data">
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
                                        <input type="text" value="'.$item['senha'].'" class="form-control" name="senha" style="width:auto !important;" id="senha" placeholder="Digite a Senha" maxlength="8">
                                    </div>
                                    
                                    <div style="float:left;">
                                        <button type="button" id="btn_cadastra" class="btn btn-outline btn-success">Salvar Alterações</button>
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
    if($("#nome").val() == "" || $('#sobrenome').val() == "" || $('#usuario').val() == "" || $('#senha').val() == ""){
        alert("Preencha todos os campos!");
    }else{
        $('#form_mensagem').submit();
    }
});
$(document).ready(function(){
    $('#usuario').mask('000.000.000-00')
})
</script>