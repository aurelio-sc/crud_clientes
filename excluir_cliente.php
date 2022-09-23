<?php
include('helpers.php');
include('conexao.php');
$id = intval($_GET['id']);
$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/excluir_cliente.css">
  <title>Excluir Cliente</title>
</head>
<?php
if (isset($_POST['excluir'])) {
  $sql_code = "DELETE FROM clientes WHERE id='$id' ";
  $sql_excluir = $mysqli->query($sql_code) or die($mysqli->error);

  if ($sql_excluir) { ?>

<body>
  <div class="wrapper">
    <div class="topo">
      <h1 class="titulo">Cliente deletado com sucesso</h1>
      <p class="obrigatorio">Por favor, selecione uma das opções abaixo:</p>
    </div>
    <div class="opcoes">
      <a class="botao" href="clientes.php">Ir para a lista</a>
      <a class="botao" href="cadastrar_cliente.php">Ir para o cadastro</a>
    </div>
  </div>
</body>

<?php
    die();
  }
}
?>

<body>
  <div class="wrapper">
    <div class="topo">
      <h1 class="titulo">Excluir cliente</h1>
      <p class="obrigatorio">Essa ação é irreversível.</p>
    </div>
    <div class="texto">
      <p class="advertencia">Deseja realmente excluir <span><?php echo $cliente['nome'] ?></span> do sistema?</p>
    </div>
    <form class="confirmar" method="POST" action="">
      <button class="botao secundario" type="submit" name="excluir" value="1">Sim</button>
      <a class="botao" href="clientes.php">Não</a>
    </form>
  </div>
</body>

</html>