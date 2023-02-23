<?php
require_once 'db_connection.php';
session_start();

// Consulta os 6 produtos mais recentes cadastrados no banco de dados
$sql = "SELECT * FROM perfumes ORDER BY id DESC LIMIT 6";
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
  <main>
    <h1>Envolva-se em fragrâncias irresistíveis,</h1>
    <h1> perfumes para todos os sentidos!</h1>
    <div class="spots-container">
      <div class="container">
        <div class="row">
          <?php foreach ($products as $key => $product) { ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <a href="produto.php?id=<?php echo $product['id']; ?>">
                  <img src="<?php echo $product['imagem']; ?>" alt="<?php echo $product['nome']; ?>" class="card-img-top">
                </a>
                <div class="card-body">
                  <h5 class="card-title">
                    <?php echo $product['nome']; ?>
                  </h5>
                  <p class="card-text">
                    <?php echo $product['marca']; ?>
                  </p>
                  <p class="card-text">
                    <?php echo $product['preco']; ?>
                  </p>
                  <a href="produto.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Ver mais</a>
                </div>
              </div>
            </div>
            <?php if (($key + 1) % 3 == 0) { ?>
            </div>
            <div class="row">
            <?php } ?>
          <?php } ?>
        </div>
      </div>
    </div>
  </main>
  <?php include('footer.php'); ?>
  <script src="./scripts.js"></script>
</body>

</html>