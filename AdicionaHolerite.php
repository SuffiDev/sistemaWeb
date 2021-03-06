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
    <title>Holerites</title>
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
                    <h1 class="page-header">Holerites</h1>
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
                            Relize o cadastro de Holerites para os Colaboradores
                        </div>
                        <div class="panel-body">
                            <div id="detalhes"> </div>
                            <form id="form_funcionario" action="cadastra_holerite.php" method="POST"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Colaborador</label>
                                    <select class="form-control"  name="colaborador" style="width:auto !important;" id="colaborador" >                                    
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
                                    <label>Mes de Referencia</label>
                                    <select class="form-control"  name="mes_ref" style="width:auto !important;" id="mes_ref" >
                                        <option value="1">Janeiro</option>
                                        <option value="2">Fevereiro</option>
                                        <option value="3">Março</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Maio</option>
                                        <option value="6">Junho</option>
                                        <option value="7">Julho</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Setembro</option>
                                        <option value="10">Outubro</option>
                                        <option value="11">Novembro</option>
                                        <option value="12">Dezembro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ano</label>
                                    <select class="form-control"  name="ano" style="width:auto !important;" id="ano" >
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Arquivo</label>
                                    <input type="file" class="form-control"name="arquivo" style="width:auto !important;" id="arquivo" placeholder="Senha:">
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

    let nome_arquivo = $('#arquivo').val();
    let nome_splitado = nome_arquivo.split('.')[1];
    
    if($("#colaborador").val() == "" || $('#mes_ref').val() == "" || $('#ano').val() == "" || $("#arquivo").val() == ''){
        alert("Preencha todos os campos!");
    }else{
        if (nome_splitado == 'pdf')
            $('form').submit();    
        else
            alert("Selecione um documento PDF válido!")
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