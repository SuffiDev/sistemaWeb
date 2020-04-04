<?php
$endereco = '127.0.0.1';
$usuario = 'matheus';
$senha = '123456';
$banco = 'sistema_web';
$conn = mysqli_connect($endereco,$usuario,$senha,$banco);

// Checa a conexão
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
