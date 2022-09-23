<?php
include('helpers.php');
include('conexao.php');

$id = intval($_GET['id']);


if (count($_POST) > 0) {
  include('conexao.php');
  $msg_erro = false;
  $msg_sucesso = false;
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $nascimento = $_POST['nascimento'];

  if (empty($nome)) {
    $msg_erro = "Por favor, preencha seu nome.";
  }
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg_erro = "Por favor, preencha seu email corretamente.";
  }
  if (!empty($telefone)) {
    $telefone = limpar_texto($telefone);
    if (strlen($telefone) != 11) {
      $msg_erro = "O número de telefone deve seguir o padrão (XX) XXXXX-XXXX.";
      unset($telefone);
    }
  }
  if (!empty($nascimento)) {
    $pedacos = explode('/', $nascimento);
    if (count($pedacos) == 3) {
      $nascimento = implode('-', array_reverse($pedacos));
    } else {
      $msg_erro = "A data de nascimento deve seguir o padrão dd/mm/aaaa.";
    }
  }

  if (!$msg_erro) {
    if (!empty($nascimento)) {
      $sql_code = "UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone', nascimento='$nascimento' WHERE id='$id'";
    } else {
      $sql_code = "UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone', nascimento=DEFAULT WHERE id='$id'";
    }
    $sucesso = $mysqli->query($sql_code) or die($mysqli->error);
    if ($sucesso) {
      $msg_sucesso = "Cliente editado com sucesso!";
      unset($_POST);
      unset($telefone);
    }
  }
}

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
  <link rel="stylesheet" href="css/cadastrar_editar_cliente.css">
  <title>Editar Cliente</title>
</head>

<body>
  <div class="wrapper">
    <div class="topo">
      <h1 class="titulo">Editar cliente</h1>
      <p class="obrigatorio"><span>*</span> Campo obrigatório.</p>
    </div>
    <form action="" method="POST">
      <div class="linha">
        <label class="label" for="nome">Nome<span>*</span>:</label>
        <input class="input" type="text" name="nome" id="nome" value="<?php echo $cliente['nome']; ?>">
      </div>
      <div class="linha">
        <label class="label" for="email">Email<span>*</span>:</label>
        <input class="input" type="text" name="email" id="email" value="<?php echo $cliente['email']; ?>">
      </div>
      <div class="linha">
        <label class="label" for="telefone">Telefone:</label>
        <input class="input" type="text" name="telefone" id="telefone" placeholder="(XX) XXXXX-XXXX"
          value="<?php if (!empty($cliente['telefone'])) echo formatar_telefone($cliente['telefone']); ?>">
      </div>
      <div class="linha">
        <label class="label" for="nascimento">Data de Nascimento:</label>
        <input class="input" type="text" name="nascimento" id="nascimento" placeholder="dd/mm/aaaa"
          value="<?php if (!empty($cliente['nascimento'])) echo formatar_data($cliente['nascimento']); ?>">
      </div>
      <div class="linha">
        <button class="botao" type="submit">Salvar Edição</button>
      </div>
    </form>
    <?php if (isset($msg_erro) && $msg_erro != false) echo "<p class='erro'>$msg_erro</p>" ?>
    <?php if (isset($msg_sucesso) && $msg_sucesso != false) echo "<p class='sucesso'>$msg_sucesso</p>" ?>
    <a class="voltar" href="clientes.php">Ir para a lista</a>
  </div>
</body>

</html>