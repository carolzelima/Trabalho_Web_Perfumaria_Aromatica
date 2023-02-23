<?php
session_start();

// incluir arquivo de conexão com o banco de dados
require_once 'db_connection.php';

// verifique se o usuário já está logado e redirecione-o para a página inicial
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// define as variáveis que receberão os valores de entrada do usuário
$email = $password = '';
$errors = array();

// verifica se o formulário foi submetido e processa os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // obtém os dados do formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // verifica se o email e a senha foram preenchidos corretamente
    if (empty($email)) {
        $errors['email'] = 'Por favor, digite seu e-mail.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Por favor, digite um e-mail válido.';
    }

    if (empty($password)) {
        $errors['password'] = 'Por favor, digite sua senha.';
    }

    // verifica se o email e a senha são válidos
    if (count($errors) == 0) {
        $query = "SELECT id, nome, email, senha FROM clientes WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($password == $user['senha']) {
            // define a variável de sessão para o ID do usuário
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user['nome'];
            // redireciona o usuário para a página inicial
            header('Location: /index.php');
            exit();
        } else {
            $errors['login'] = 'E-mail ou senha inválidos.';
        }
    }
}

// fecha a conexão com o banco de dados
mysqli_close($conn);
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
    <form action="login.php" method="post">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase"> Entre com a sua conta</h2>
                                    <p class="text-white-50 mb-5">Por favor, coloque o seu login e senha!</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" class="form-control form-control-lg"
                                            name="email" />
                                        <label class="form-label" for="email">E-mail</label>
                                        <?php if (isset($errors['email'])) { ?>
                                            <div class="error-message">
                                                <?php echo $errors['email']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="password" class="form-control form-control-lg"
                                            name="password" />
                                        <label class="form-label" for="password">Senha</label>
                                        <?php if (isset($errors['password'])) { ?>
                                            <div class="error-message">
                                                <?php echo $errors['password']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>



                                    <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                        name="submit">Entrar</button>
                                </div>
                                <hr class="my-4">
                                <div>
                                    <p class="mb-0">Não tem uma conta? <a href="cadastro.php"
                                            class="text-white-50 fw-bold">Crie a sua conta aqui!
                                        </a>
                                    </p>
                                    <p class="text-center">
                                    <p>Aromática LTDA © 2023 - Todos os direitos reservados.</p>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>