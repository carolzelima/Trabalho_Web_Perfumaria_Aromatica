<?php
require_once 'db_connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];

    // verifica se o email já está cadastrado
    $query = "SELECT * FROM clientes WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $erro = "O email já está cadastrado. Tente outro.";
    } else {
        // insere o novo cliente na tabela clientes
        $query = "INSERT INTO clientes (nome, endereco, email, telefone, senha) VALUES ('$nome', '$endereco', '$email', '$telefone', '$senha')";
        mysqli_query($conn, $query);

        // redireciona o usuário para a página de login
        header('Location: login.php');
        exit();
    }
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
    <main>
        <?php include('header.php'); ?>
        <?php
        if (isset($_SESSION['user_id'])) {
            // usuário já está logado, redirecione para a página principal
            header('Location: index.php');
            exit();
        } else {
            ?>
            <!-- Código HTML do formulário de cadastro -->
            <?php if (isset($erro)) { ?>
                <p class="erro">
                    <?php echo $erro; ?>
                </p>
            <?php } ?>
            <form action="cadastro.php" method="post">
                <section class="vh-100 gradient-custom">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">

                                        <div class="mb-md-5 mt-md-4 pb-5">

                                            <h2 class="fw-bold mb-2 text-uppercase">Cadastre sua conta!</h2>
                                            <p class="text-white-50 mb-5">Por favor, preencha os campos abaixo:</p>

                                            <div class="form-outline form-white mb-4">
                                                <input type="name" id="nome" class="form-control form-control-lg"
                                                    name="nome" />
                                                <label class="nome" for="name">Nome</label>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="sobrenome" class="form-control form-control-lg"
                                                    name="sobrenome" />
                                                <label class="sobrenome" for="sobrenome">Sobrenome</label>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="endereco" class="form-control form-control-lg"
                                                    name="endereco" />
                                                <label class="endereco" for="">Endereço</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="email" id="email" class="form-control form-control-lg"
                                                    name="email" />
                                                <label class="form-label" for="email">E-mail</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="password" id="" class="form-control form-control-lg"
                                                    name="senha" />
                                                <label class="form-label" for="senha">Senha</label>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <input type="tel" id="telefone" class="form-control form-control-lg"
                                                    name="telefone" />
                                                <label class="form-label" for="telefone">Celular</label>
                                            </div>



                                            <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                                name="submit">Cadastrar</button>
                                        </div>
                                        <hr class="my-4">
                                        <p class="text-center">
                                        <p>Aromática LTDA © 2023 - Todos os direitos reservados.</p>
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        <?php } ?>
    </main>

</html>
<?php
// fecha a conexão com o banco de dados
mysqli_close($conn);
?>