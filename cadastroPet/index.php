<?php
session_start();
require_once "../conexao.php";

// Se não estiver logado, redireciona para login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../cadastro/index.php");
    exit();
}

// Dados do usuário
$emailUsuario = $_SESSION['usuario_email'] ?? '';
$nomeUsuario  = $_SESSION['usuario_nome'] ?? '';
$fotoUsuario  = $_SESSION['usuario_foto'] ?? 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';

// PROCESSAMENTO DO FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = $_POST['nome'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $raca    = $_POST['raca'] ?? '';
    $idade   = $_POST['idade'] ?? null;
    $dono    = $_POST['dono'] ?? '';
    $fotoPet = null;

    // Upload da foto do pet
    if (!empty($_FILES['foto']['name'])) {
        $pasta = "../uploads/pets/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $nomeArquivo = uniqid() . "-" . basename($_FILES['foto']['name']);
        $caminho = $pasta . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
            $fotoPet = $caminho;
        }
    }

    // Conexão com o banco vacinapets
    $conexao = new mysqli("localhost", "root", "", "vacinapets");
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }

    // Insert no banco
    $sql = "INSERT INTO pets (nome, especie, raca, idade, dono, foto) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssiss", $nome, $especie, $raca, $idade, $dono, $fotoPet);

    if ($stmt->execute()) {
        echo "<script>alert('Pet cadastrado com sucesso!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar pet: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conexao->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pet - VacinaPets</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .user-menu {
            position: relative;
            display: inline-block;
        }
        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            background: #fff;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 8px;
            padding: 10px;
            text-align: left;
        }
        .dropdown p {
            margin: 5px 0;
            font-size: 14px;
            color: #333;
        }
        .dropdown a {
            display: block;
            text-decoration: none;
            color: #e74c3c;
            margin-top: 10px;
        }
        .user-menu:hover .dropdown {
            display: block;
        }
    </style>
</head>
<body>
    <!-- MENU -->
    <header class="navbar">
        <div class="logo">VacinaPets</div>
        <nav>
            <ul>
                <?php if (!isset($_SESSION['usuario_email'])): ?>
                    <li><a href="../cadastro/index.php">Cadastrar Usuário</a></li>
                <?php endif; ?>
                <li><a href="index.php" class="active">Cadastrar Pet</a></li>
                <li>
                    <div class="user-menu">
                        <img src="<?= $fotoUsuario ?>" alt="Usuário" class="user-icon">
                        <div class="dropdown">
                            <p><strong><?= htmlspecialchars($nomeUsuario) ?></strong></p>
                            <p><?= htmlspecialchars($emailUsuario) ?></p>
                            <a href="../logout/logout.php">Sair</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- CONTEÚDO -->
    <main>
        <div class="form-container">
            <h2>Cadastro de Pet</h2>
            <form method="POST" enctype="multipart/form-data">
                <label>Nome do Pet</label>
                <input type="text" name="nome" required>

                <label>Espécie</label>
                <select name="especie" required>
                    <option value="Cachorro">Cachorro</option>
                    <option value="Gato">Gato</option>
                    <option value="Outro">Outro</option>
                </select>

                <label>Raça</label>
                <input type="text" name="raca">

                <label>Idade (em anos)</label>
                <input type="number" name="idade" min="0">

                <label>Nome do Dono</label>
                <input type="text" name="dono" required>

                <label>Foto do Pet</label>
                <input type="file" name="foto" accept="image/*">

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
</body>
</html>
