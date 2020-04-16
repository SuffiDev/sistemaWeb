<?php
 //Verificação da sessão
 session_start();
 if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != TRUE ){
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
    <title>Minhas Mensagens</title>
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
                    if($_SESSION['ADMIN'] == TRUE)
                        include ('menuAdmin.php');
                    else
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
                    <h1 class="page-header">Minhas Mensagens</h1>
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
                <div class="table-responsive">
                    <p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Data</th>
                                    <th align="center">#</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            require("conexao.php");
                            $query = "SELECT * FROM tb_mensagem INNER JOIN tb_leitura ON (tb_leitura.id_mensagem = tb_mensagem.id) WHERE tb_leitura.id_usuario = '".$_SESSION['id']."';";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result) > 0){
                                while($item=mysqli_fetch_array($result)){
                                    echo'<tr>
                                        <td>'.$item['titulo'].'</td>
                                        <td>'.date("d/m/Y H:m:s", strtotime($item['data_cadastro'])).'</td>
                                        <td>
                                            <a href="javascript:modalMensagem('.$item["id_mensagem"].')"  id="editar" ><p class="fa fa-eye"></p> Visualizar Mensagem completa</a>&nbsp;
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
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    
                </div>
            </div>
        </div>

    </div>
</body>

</html>
<script>
function modalMensagem(id){
    $.ajax({url: "DetalhesModal.php?id="+id, success: function(result){
        $("#myModal").html(result).modal();
  }});
}
</script>