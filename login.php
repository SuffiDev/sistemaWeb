<?php 
    $retorno_php = $_GET['retorno'];
    if($retorno_php != ""){
        echo '<script language="javascript">';
        echo 'alert("Usuario ou senha inválidos!");';
        echo '</script>';
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

    <title>Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align:center;"><img style="width:200px;" src="imgs/logoSmartQuimica.png"></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="post_login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" id="usuario" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="password" id="senha" type="password" value="">
                                </div>
                                <div class="form-group">
                                <select class="form-control" id="tipo_login" name="tipo_login">
                                    <option class="form-control" value="colaborador">Colaborador</option>
                                    <option class="form-control" value="admin">Admin</option>
                                </select>
                                </div>
                                <!--<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Lembrar Senha
                                    </label>
                                </div> !-->
                                <button type="button" id="btnLogin"class="btn btn-outline btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
$('#btnLogin').click(function(){
  var email = $('#email').val();
  var senha = $('#senha').val();
  if((email != "") && (senha != "")){
    $('form').submit();
  }else{
    alert("Preencha corretamente o E-Mail e a Senha");
  }
});
</script>
</html>
