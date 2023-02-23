<?php
session_start();

// incluir arquivo de conexão com o banco de dados
require_once 'db_connection.php';
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
        <div class="container">
            <?php
            // inclua o arquivo de conexão com o banco de dados
            include('db_connection.php');

            // verifique se o ID do produto está presente na URL
            if (isset($_GET['id'])) {
                // obtenha o ID do produto da URL
                $product_id = $_GET['id'];

                // execute a consulta SQL para obter as informações do produto com base no ID
                $query = "SELECT * FROM perfumes WHERE id = $product_id";
                $result = mysqli_query($conn, $query);

                // verifique se a consulta SQL retornou algum resultado
                if (mysqli_num_rows($result) == 1) {
                    // obtenha as informações do produto a partir do resultado da consulta
                    $product = mysqli_fetch_assoc($result);
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo $product['imagem']; ?>" alt="<?php echo $product['nome']; ?>"
                                class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h1>
                                <?php echo $product['nome']; ?>
                            </h1>
                            <p class="lead">
                                <?php echo $product['descricao']; ?>
                            </p>
                            <p class="h3"><strong>Preço: R$
                                    <?php echo $product['preco']; ?>
                                </strong></p>
                            <hr class="my-4">
                            <form action="carrinho.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button type="submit" class="btn btn-primary btn-lg">Adicionar ao carrinho</button>
                            </form>
                        </div>
                    </div>
                    <?php
                } else {
                    // se a consulta SQL não retornar nenhum resultado, mostre uma mensagem de erro
                    echo "<div class='alert alert-danger'>Produto não encontrado.</div>";
                }
            } else {
                // se o ID do produto não estiver presente na URL, redirecione o usuário para a página inicial
                header("Location: index.php");
                exit();
            }

            // feche a conexão com o banco de dados
            mysqli_close($conn);
            ?>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script src="./scripts.js"></script>
</body>

</html>