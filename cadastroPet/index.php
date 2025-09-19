<?php
session_start();
require_once "../conexao.php";

// Verifica se usuário está logado
if (!isset($_SESSION['usuario'])) {
    echo "<script>
        alert('Você precisa estar logado para cadastrar um pet.');
        window.location='../cadastro/index.php';
    </script>";
    exit();
}

// Dados do usuário logado
$idUsuario   = $_SESSION['id_usuario'];
$emailUsuario = $_SESSION['usuario_email'] ?? '';
$nomeUsuario  = $_SESSION['usuario_nome'] ?? '';
$fotoUsuario  = $_SESSION['usuario_foto'] ?? 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png';

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome    = $_POST['nome'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $raca    = $_POST['raca'] ?? '';
    $idade   = $_POST['idade'] ?? null;
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

    // Insert no banco
    $sql = "INSERT INTO pets (nome, especie, raca, idade, foto, id_usuario) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro no prepare: " . $conn->error);
    }

    $stmt->bind_param("sssisi", $nome, $especie, $raca, $idade, $fotoPet, $idUsuario);

    if ($stmt->execute()) {
        echo "<script>
            alert('Pet cadastrado com sucesso!');
            window.location='../home/index.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Erro ao cadastrar pet: " . $stmt->error . "');</script>";
    }

    $stmt->close();
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

        .form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-container button {
            background: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            margin-top: 15px;
        }

        .form-container button:hover {
            background: #2980b9;
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo">VacinaPets</div>
        <nav>
            <ul>
                <li><a href="../home/index.php">Home</a></li>
                <li><a href="index.php" class="active">Cadastrar Pet</a></li>
                <li>
                    <div class="user-menu">
                        <img src="<?= htmlspecialchars($fotoUsuario) ?>" alt="Usuário" class="user-icon">
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

                <label>Foto do Pet</label>
                <input type="file" name="foto" accept="image/*">

                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
</body>

</html>