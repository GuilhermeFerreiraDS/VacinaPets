<?php
session_start();
include("../conexao.php");

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../home/index.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Buscar pets do usuário
$sqlPets = "SELECT * FROM pets WHERE id_usuario = ?";
$stmtPets = $conn->prepare($sqlPets);
$stmtPets->bind_param("i", $id_usuario);
$stmtPets->execute();
$resultPets = $stmtPets->get_result();
$pets = $resultPets->fetch_all(MYSQLI_ASSOC);
$stmtPets->close();

// Determinar qual pet selecionar
$id_pet_selecionado = $_GET['pet'] ?? ($pets[0]['id'] ?? null);

// Buscar agendamentos desse pet
$agendamentos = [];
if ($id_pet_selecionado) {
    $sqlAgenda = "SELECT a.data, a.hora, a.observacoes, v.nome AS vacina
                  FROM agendamentos a
                  JOIN vacinas v ON a.id_vacina = v.id_vacina
                  WHERE a.id_pet = ?
                  ORDER BY a.data ASC, a.hora ASC";
    $stmtAgenda = $conn->prepare($sqlAgenda);
    $stmtAgenda->bind_param("i", $id_pet_selecionado);
    $stmtAgenda->execute();
    $resultAgenda = $stmtAgenda->get_result();
    $agendamentos = $resultAgenda->fetch_all(MYSQLI_ASSOC);
    $stmtAgenda->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Histórico de Vacinação - VacinaPets</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
    }
    header {
        background: #4CAF50;
        color: white;
        padding: 1rem;
        text-align: center;
    }
    main {
        max-width: 800px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    select {
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 1rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    table th, table td {
        border: 1px solid #ccc;
        padding: 0.75rem;
        text-align: left;
    }
    table th {
        background: #4CAF50;
        color: white;
    }
    table tr:nth-child(even) {
        background: #f9f9f9;
    }
</style>
<script>
function mudarPet() {
    const select = document.getElementById('petSelect');
    const petId = select.value;
    window.location.href = '?pet=' + petId;
}
</script>
</head>
<body>
<header>
    <h1>Histórico de Vacinação</h1>
</header>
<main>

    <label for="petSelect">Selecione o Pet:</label>
    <select id="petSelect" onchange="mudarPet()">
        <?php foreach($pets as $p): ?>
            <option value="<?= $p['id'] ?>" <?= ($p['id']==$id_pet_selecionado)?'selected':'' ?>>
                <?= htmlspecialchars($p['nome']) ?> (<?= htmlspecialchars($p['especie']) ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <?php if(empty($agendamentos)): ?>
        <p>Este pet ainda não possui vacinas registradas.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Vacina</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Observações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($agendamentos as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['vacina']) ?></td>
                        <td><?= htmlspecialchars($a['data']) ?></td>
                        <td><?= htmlspecialchars($a['hora']) ?></td>
                        <td><?= htmlspecialchars($a['observacoes']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</main>
</body>
</html>
