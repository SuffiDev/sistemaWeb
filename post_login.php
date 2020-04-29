<?php
require("conexao.php");
$usuario = preg_replace('/[ .-]/','',$_POST['usuario']);
$senha = $_POST["password"];
$tipo = $_POST["tipo_login"];
$busca = "SELECT * FROM tb_usuario WHERE usuario='".$usuario."' AND senha='".$senha."' AND tipo='".$tipo."' limit 1;";
$result = mysqli_query($conn, $busca);
if (mysqli_num_rows($result) > 0) {
	session_cache_expire(30);
	while($item=mysqli_fetch_array($result)){
		session_start();
        $_SESSION['logado'] = TRUE;
        $tipo_login;
        if ($tipo == 'admin'){
            $tipo_login = 1;
        }else{
            $tipo_login = 0;
        }
        $_SESSION['admin'] = $tipo_login;
		$_SESSION['nome'] = $item['nome'];
		$_SESSION['id'] = $item['id'];
		$_SESSION['usuario'] = $item['usuario'];
        $_SESSION['senha'] = $item['senha'];
        if($item['primeiro_login'] == 0)
            $_SESSION['primeiro_login'] = TRUE;
        else
            $_SESSION['primeiro_login'] = FALSE;
    }
    
    if ($tipo == 'colaborador'){
        header("Location: index.php");
    }
    else{
        header("Location: indexAdmin.php");
    }
}else{
  header("Location: login.php?retorno=usuario_ou_senha_invalidos");
}
?>
