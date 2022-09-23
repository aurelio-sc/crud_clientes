<?php
include('conexao.php');
include('helpers.php');
$sql_clientes = "SELECT * FROM clientes";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/clientes.css">
  <title>Lista de Clientes</title>
</head>

<body>
  <div class="wrapper">
    <div class="topo">
      <h1 class="titulo">Lista de Clientes</h1>
    </div>
    <table>
      <thead>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Nascimento</th>
        <th>Data</th>
        <th>Ações</th>
      </thead>
      <tbody>
        <?php if ($num_clientes == 0) { ?>
        <tr>
          <td colspan="7">Nenhum cliente cadastrado.</td>
        </tr>
        <?php } else {
          while ($cliente = $query_clientes->fetch_assoc()) {
            $telefone = 'Não cadastrado';
            if (!empty($cliente['telefone'])) {
              $telefone = formatar_telefone(($cliente['telefone']));
            }
            $nascimento = 'Não cadastrado';
            if (!empty($cliente['nascimento'])) {
              $nascimento = formatar_data($cliente['nascimento']);
            }
            $data_cadastro = date('d/m/Y', strtotime($cliente['data']))
          ?>
        <tr>
          <td><?php echo $cliente['id']; ?></td>
          <td><?php echo $cliente['nome']; ?></td>
          <td><?php echo $cliente['email']; ?></td>
          <td><?php echo $telefone ?></td>
          <td><?php echo $nascimento; ?></td>
          <td><?php echo $data_cadastro; ?></td>
          <td class="acoes">
            <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>" class="acao editar">Editar</a>
            <a href="excluir_cliente.php?id=<?php echo $cliente['id']; ?>" class="acao deletar">Deletar</a>
          </td>
        </tr>
        <?php }
        } ?>
      </tbody>
    </table>
    <a class="voltar" href="cadastrar_cliente.php">Ir para o cadastro</a>
  </div>
</body>

</html>