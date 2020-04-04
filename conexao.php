<?php
$endereco = "rh.smartquimica.com.br";
$usuario = "smartqui_user";
$senha = "Wgo9e57h)e@6";
$banco = "smartqui_rh";
$conn = mysqli_connect($endereco,$usuario,$senha,$banco);

// Checa a conexão
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
