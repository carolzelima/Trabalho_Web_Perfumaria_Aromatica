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
        
            echo '<h1 class="my-4">Minha Conta</h1>';
            echo '<p class="user-data">Nome: ' . $user['nome'] . '</p>';
            echo '<p class="user-data">Sobrenome: ' . $user['sobrenome'] . '</p>';
            echo '<p class="user-data">Endereço: ' . $user['endereco'] . '</p>';
            echo '<p class="user-data">E-mail: ' . $user['email'] . '</p>';
            echo '<p class="user-data">Celular: ' . $user['telefone'] . '</p>';
            echo '<h2 class="my-4">Minhas Compras</h2>';
            
            
            if (count($compras) > 0) {
                echo "<table>";
                echo "<tr><th>Produto</th><th>Preço</th><th>Data da Compra</th></tr>";
                foreach ($compras as $compra) {
                    $produto_id = $compra['produto_id'];
                    $query = "SELECT nome, preco FROM perfumes WHERE id = $produto_id";
                    $result = mysqli_query($conn, $query);
                    $produto = mysqli_fetch_assoc($result);
                    echo "<tr>";
                    echo "<td>{$produto['nome']}</td>";
                    echo "<td>{$produto['preco']}</td>";
                    echo "<td>{$compra['data']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Você ainda não realizou nenhuma compra.</p>";
            }
        } ?>
    </main>
    <?php include('footer.php'); ?>

</html>

<?php
// fecha a conexão com o banco de dados
mysqli_close($conn);
?>