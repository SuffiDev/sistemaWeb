<?php
 //Verificação da sessão
 session_start();
 if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != 1){
   header("Location: login.php");
 }
 if($_SESSION['primeiro_login'])
 echo '<script>
         var r = confirm("Bem-Vindo!\nSua senha padrão ainda não foi alterada! Clique aqui para alterar");
         if (r == true) {
             window.location.href = "MeuPerfil.php";
         } 
     </script>'
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Index</title>
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
                        include ('menuColaborador.php');
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
                    <h1 class="page-header">Index</h1>
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
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Mensagens não lidas
                        </div>
                        <div class="panel-body">
                            <?php  
                                require("conexao.php");
                                $query = "SELECT SUBSTRING(corpo, 1, 20) as corpo, titulo,tb_mensagem.id, data_cadastro FROM tb_mensagem INNER JOIN tb_leitura ON (tb_leitura.id_mensagem = tb_mensagem.id) WHERE tb_leitura.id_usuario = '".$_SESSION["id"]."' AND lido = '0' order by data_cadastro DESC limit 5";
                                $result = mysqli_query($conn,$query);
                                if(mysqli_num_rows($result) > 0){
                                    while($item=mysqli_fetch_array($result)){
                                        echo '<div class="list-group">
                                                <a class="list-group-item">
                                                    <i class="fa fa-comment fa-fw"></i> '.$item['corpo'].'
                                                    <span class="pull-right text-muted small"><em>'.date("d/m/Y H:m:s", strtotime($item['data_cadastro'])).'</em>
                                                    </span>
                                                </a>                                    
                                            </div>'; 
                                            
                                    }
                                    echo '<a href="MinhasMensagens.php" class="btn btn-default btn-block">Ver todas as mensagens</a>';
                                }else{
                                    echo '<p  class="">Nenhuma mesagem encontrada</a><p>
                                            <a href="MinhasMensagens.php" class="btn btn-default btn-block">Ver todas as mensagens</a>';
                                }
                            ?>            
                            
                            
                        </div>
                    </div>     
                </div>   
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Ultimos Holerites
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr >
                                            <th>Mês</th>
                                            <th>Ano</th>
                                            <th>Ação</th>
                                        </tr>  
                                    </thead>
                                    <tbody>
                                        <?php  
                                            require("conexao.php");
                                            $query = "select * from tb_holerite where id_usuario = '".$_SESSION['id']."' order by id DESC limit 5";
                                            $result = mysqli_query($conn,$query);
                                            if(mysqli_num_rows($result) > 0){
                                                while($item=mysqli_fetch_array($result)){
                                                    $i = $item['mes_referencia'];
                                                    $mes = '';
                                                    if($i == 1)
                                                        $mes = 'Janeiro';
                                                    elseif($i == 2)
                                                        $mes = 'Fevereiro';
                                                    elseif($i == 3)
                                                        $mes = 'Março';
                                                    elseif($i == 4)
                                                        $mes = 'Abril';
                                                    elseif($i == 5)
                                                        $mes = 'Maio';
                                                    elseif($i == 6)
                                                        $mes = 'Junho';
                                                    elseif($i == 7)
                                                        $mes = 'Julho';
                                                    elseif($i == 8)
                                                        $mes = 'Agosto';
                                                    elseif($i == 9)
                                                        $mes = 'Setembro';
                                                    elseif($i == 10)
                                                        $mes = 'Outubro';
                                                    elseif($i == 11)
                                                        $mes = 'Novembro';
                                                    elseif($i == 12)
                                                        $mes = 'Dezembro';
                                                    echo '<tr>
                                                            <td>'.$mes.'</td>
                                                            <td>'.$item['ano_referencia'].'</td>
                                                            <td><a target="_blank" href="'.$item['caminho_documento'].'" id="visualizar" ><p class="fa fa-eye"></p> Visualizar</a>&nbsp;</td>
                                                        </tr>'; 
                                                        
                                                }
                                            }else{
                                                echo '<tr>
                                                        <td>Nenhum registro encontrado</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>';
                                            }
                                        ?>           
                                        
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>     
                </div>   
            </div> 
        </div>
    </div>
</body>

</html>
