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
    <script src="js/datatables.js"></script>
    <link href="dist/css/datatables.css" rel="stylesheet">
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
                <button type="button" class="btn btn-outline btn-primary" onclick="window.location.href='AdicionaFuncionario.php'">Adicionar</button>
                <p>
                <div class="table-responsive">
                    <p>
                    <table id="myTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Tipo</th>
                                    <th align="center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            require("conexao.php");
                            $query = "SELECT * FROM tb_usuario;";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result) > 0){
                                while($item=mysqli_fetch_array($result)){
                                    $tipo = '';
                                    if($item['tipo'] == 'admin')
                                        $tipo = '<i class="fa fa-user"> Administrador</i>';
                                    else
                                        $tipo = '<i class="fa fa-user"> Colaborador</i>';
                                    echo'<tr>
                                        <td>'.$item['nome'].'</td>
                                        <td>'.$item['sobre_nome'].'</td>
                                        <td>'.$tipo.'</td>
                                        <td>
                                            <a href="EditaFuncionario.php?id='.$item['id'].'" id="editar" ><p class="fa fa-edit"></p> Editar</a>&nbsp;
                                            <a href="deleta.php?id='.$item['id'].'&tabela=usuario" id="excluir" ><p class="fa fa-trash"></p> Excluir</a>
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
</script>