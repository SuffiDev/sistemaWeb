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
                <button type="button" class="btn btn-outline btn-primary" onclick="window.location.href='AdicionaHolerite.php'">Adicionar</button>
                <p>
                <div class="table-responsive">
                    <p>
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Colaborador</th>
                                <th>Mês de referencia</th>
                                <th>Ano</th>
                                <th align="center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            require("conexao.php");
                            $query = "SELECT holerite.id_usuario,holerite.id,holerite.caminho_documento, holerite.mes_referencia, holerite.ano_referencia, usuario.nome FROM tb_holerite holerite INNER JOIN tb_usuario usuario ON (holerite.id_usuario = usuario.id);";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result) > 0){
                                while($item=mysqli_fetch_array($result)){
                                    $mes_ref = '';
                                    if($item['mes_referencia'] == 1)
                                        $mes_ref = 'Janeiro';
                                    elseif($item['mes_referencia'] == 2)
                                        $mes_ref = 'Fevereiro';
                                    elseif($item['mes_referencia'] == 3)
                                        $mes_ref = 'Março';
                                    elseif($item['mes_referencia'] == 4)
                                        $mes_ref = 'Abril';
                                    elseif($item['mes_referencia'] == 5)
                                        $mes_ref = 'Maio';
                                    elseif($item['mes_referencia'] == 6)
                                        $mes_ref = 'Junho';
                                    elseif($item['mes_referencia'] == 7)
                                        $mes_ref = 'Julho';
                                    elseif($item['mes_referencia'] == 8)
                                        $mes_ref = 'Agosto';
                                    elseif($item['mes_referencia'] == 9)
                                        $mes_ref = 'Setembro';
                                    elseif($item['mes_referencia'] == 10)
                                        $mes_ref = 'Outubro';
                                    elseif($item['mes_referencia'] == 11)
                                        $mes_ref = 'Novembro';
                                    elseif($item['mes_referencia'] == 12)
                                        $mes_ref = 'Dezembro';
                                    echo'<tr>
                                        <td>'.$item['nome'].'</td>
                                        <td>'.$mes_ref.'</td>
                                        <td>'.$item['ano_referencia'].'</td>
                                        <td>
                                            <a target="_blank" href="'.$item['caminho_documento'].'" id="visualizar" ><p class="fa fa-eye"></p> Visualizar</a>&nbsp;
                                            <a style="color:red" href="javascript:deleta('.$item['id'].')" id="excluir" ><p class="fa fa-trash"></p> Excluir</a>
                                        </td>
                                    </tr>';
                                }
                            }else{
                                echo"<tr><td>Nenhum registro encontrado...</td><td></td><td></td><td></td>";
                            }

                            ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        "aaSorting": [[ '1', "asc" ]],
        "iDisplayLength":'10',
        "oLanguage": {
            "sSearch": "Busca:",
            "sLengthMenu": "Listar _MENU_ registros por pagina",
            "sZeroRecords": "Nada encontrado - =/",
            "sInfo": "Listando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Listando 0 a 0 de 0 registros",
            "sInfoFiltered": "(_MAX_ registros filtrados)",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Próximo",
                "sLast":     "Último"
            }
        }
    } );

});
function deleta(id){
    var r = confirm("Deseja mesmo remover este registro?");
    if (r == true){
        location.href = `deleta.php?id=${id}&tabela=holerite`
    }
}
</script>