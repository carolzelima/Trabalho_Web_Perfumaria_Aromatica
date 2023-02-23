<?php
require_once 'db_connection.php';

// Inicia a sessão para acessar a variável $_SESSION
session_start();

// Array que armazenará os produtos do carrinho
$cart = array();

if (!isset($_SESSION['user'])) {
  header('Location: /login.php');
  exit();
}

// Verifica se já há produtos no carrinho
if (isset($_SESSION['cart'])) {
  $cart = $_SESSION['cart'];
} else {
  $_SESSION['cart'] = null;
}

// Inicializa a variável do total
$total = 0;

// Loop através de cada item no carrinho
foreach ($cart as $item) {
  // Soma o valor do produto ao total
  $total += $item['preco'];
}

// Verifica se um produto foi adicionado ao carrinho
if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $product = mysqli_query($conn, "SELECT * FROM perfumes WHERE id = $id");
  $product = mysqli_fetch_assoc($product);
  if ($product) {
    // Adiciona o produto ao carrinho
    array_push($cart, $product);
    // Atualiza a variável de sessão
    $_SESSION['cart'] = $cart;

    // Insere o produto no carrinho no banco de dados
    $cliente_id = $_SESSION['user_id'];
    $produto_id = $product['id'];
    $quantidade = 1; // Para simplificar, a quantidade sempre é 1
    $query = "INSERT INTO carrinho (cliente_id, produto_id, quantidade) VALUES ($cliente_id, $produto_id, $quantidade)";
    mysqli_query($conn, $query);
  }
}

// Verifica se o botão "Remover" foi clicado
if (isset($_POST['remove'])) {
  // Pega o ID do produto a ser removido
  $product_id = $_POST['product_id'];

  // Loop através de cada item no carrinho para localizar o produto
  foreach ($cart as $key => $item) {
    if ($item['id'] == $product_id) {
      // Remove o produto do carrinho usando a função unset
      unset($cart[$key]);
      // Atualiza a variável de sessão
      $_SESSION['cart'] = $cart;
      // Remove o produto da tabela carrinho no banco de dados
      $query = "DELETE FROM carrinho WHERE cliente_id = {$_SESSION['user_id']} AND produto_id = $product_id";
      mysqli_query($conn, $query);
      // Sai do loop
      break;
    }
  }

  // Redireciona o usuário para a página do carrinho
  header('Location: /carrinho.php');
  exit();
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Aromática - Carrinho</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
  <?php include('header.php'); ?>

  <div class="container my-4">
    <?php if (count($cart) == 0): ?>
      <h3>Seu carrinho está vazio.</h3>
    <?php else: ?>
      <h3>Seu carrinho:</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Produto</th>
            <th scope="col">Preço</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $key => $item): ?>
            <tr>
              <th style="width: 10%;" scope="row">
                <img src="<?php echo $item['imagem'] ?>" class="w-10 img-fluid img-thumbnail" />
              </th>
              <td>
                <?php echo $item['nome'] ?>
              </td>
              <td>R$
                <?php echo number_format($item['preco'], 2, ',', '.') ?>
              </td>
              <td>
                <form method="POST" action="/carrinho.php">
                  <input type="hidden" name="product_id" value="<?php echo $item['id'] ?>">
                  <button type="submit" class="btn btn-danger" name="remove">Remover</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <h4 class="text-right">Total: R$
        <?php echo number_format($total, 2, ',', '.') ?>
      </h4>
    <?php endif; ?>
  </div>
  <?php include('footer.php'); ?>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>