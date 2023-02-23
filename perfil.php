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

    <main class="container my-4">
        <?php
        // verifica se o usuário está logado
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            // busca as informações do usuário na tabela clientes
            $query = "SELECT * FROM clientes WHERE id = $user_id";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            // busca as compras do usuário na tabela compras
            $query = "SELECT * FROM compras WHERE id_cliente = $user_id";
            $result = mysqli_query($conn, $query);
            $compras = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // exibe as informações do usuário e suas compras
            ?>
            <div class="row">
                <div class="col-md-6 bg-dark text-white rounded">
                    <h1>Minha Conta</h1>
                    <p><strong>Nome:</strong>
                        <?php echo $user['nome'] . ' ' . $user['sobrenome']; ?>
                    </p>
                    <p><strong>Endereço:</strong>
                        <?php echo $user['endereco']; ?>
                    </p>
                    <p><strong>E-mail:</strong>
                        <?php echo $user['email']; ?>
                    </p>
                    <p><strong>Celular:</strong>
                        <?php echo $user['telefone']; ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <h2>Minhas Compras</h2>
                    <?php if (count($compras) > 0) { ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Data da Compra</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($compras as $compra) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $compra['nome_produto']; ?>
                                        </td>
                                        <td>
                                            <?php echo 'R$ ' . number_format($compra['preco_produto'], 2, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <?php echo date('d/m/Y', strtotime($compra['data'])); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>Você ainda não realizou nenhuma compra.</p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </main>

    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// fecha a conexão com o banco de dados
mysqli_close($conn);
?>
