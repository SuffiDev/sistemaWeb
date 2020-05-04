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
                                    <input type="text" value="'.$item['titulo'].'" style="width:500px !important;" class="form-control" name="titulo" style="width:auto !important;" id="titulo" placeholder="Digite o nome do banner">
                                </div>
                                <div class="form-group">
                                    <label>Corpo</label>
                                    <textarea class="form-control" name="corpo" style="height: 200px !important" id="corpo" placeholder="Digite o site do banner">'.$item['corpo'].'</textarea> 
                                </div>
                                <div class="form-group">
                                    <label>Colaboradores</label>                                    
                                    <select multiple="" name="colaboradores[]" style="height: 300px !important" id="colaboradores" class="form-control">
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