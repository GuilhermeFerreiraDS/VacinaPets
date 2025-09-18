<?php
session_start();
include("../conexao.php");

// CADASTRO
if (isset($_POST['cadastrar'])) {
    $nome  = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro: Email já cadastrado.');</script>";
    }
}

// LOGIN
if (isset($_POST['entrar'])) {
    $email = $_POST['loginEmail'];
    $senha = $_POST['loginSenha'];

    $sql = "SELECT * FROM usuarios WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = true;
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header("Location: ../home/index.php");
            exit();
        } else {
            echo "<script>alert('Senha incorreta!');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VacinaPets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- LOGIN -->
        <form id="loginForm" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="loginEmail">Email</label>
                <input type="email" name="loginEmail" required>
            </div>
            <div class="form-group">
                <label for="loginSenha">Senha</label>
                <input type="password" name="loginSenha" required>
            </div>
            <button type="submit" name="entrar">Entrar</button>
            <div class="toggle">
                Não tem conta? <a onclick="mostrarCadastro()">Cadastre-se</a>
            </div>
        </form>

        <!-- CADASTRO -->
        <form id="cadastroForm" method="POST" style="display:none;">
            <h2>Cadastro</h2>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" required>
            </div>
            <button type="submit" name="cadastrar">Cadastrar</button>
            <div class="toggle">
                Já tem conta? <a onclick="mostrarLogin()">Entrar</a>
            </div>
        </form>
    </div>

    <script>
        function mostrarCadastro() {
            document.getElementById("loginForm").style.display = "none";
            document.getElementById("cadastroForm").style.display = "block";
        }
        function mostrarLogin() {
            document.getElementById("cadastroForm").style.display = "none";
            document.getElementById("loginForm").style.display = "block";
        }
    </script>
</body>
</html>
