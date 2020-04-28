<?php
 //Verificação da sessão
 session_start();
 if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE || $_SESSION['ADMIN'] == TRUE){
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
                    include ('menuColaborador.php');
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
