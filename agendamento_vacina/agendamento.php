<?php
session_start();
include("../conexao.php");

// Verifica se usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../home/index.php");
    exit();
}

// Buscar pets do usuário
$id_usuario = $_SESSION['id_usuario'];
$sqlPets = "SELECT * FROM pets WHERE id_usuario = ?";
$stmtPets = $conn->prepare($sqlPets);
$stmtPets->bind_param("i", $id_usuario);
$stmtPets->execute();
$resultPets = $stmtPets->get_result();
$pets = $resultPets->fetch_all(MYSQLI_ASSOC);
$stmtPets->close();

// Buscar vacinas
$sqlVacinas = "SELECT * FROM vacinas";
$resultVacinas = $conn->query($sqlVacinas);
$vacinas = [];
while ($row = $resultVacinas->fetch_assoc()) {
    $vacinas[] = $row;
}

// Processar agendamento
$mensagem_modal = ""; // Modal de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pet = $_POST['pet'] ?? null;
    $id_vacina = $_POST['vacina'] ?? null;
    $data = $_POST['data'] ?? null;
    $hora = $_POST['hora'] ?? null;
    $observacao = $_POST['observacao'] ?? null;

    if ($id_pet && $id_vacina && $data && $hora) {
        // Verifica se já existe agendamento no mesmo dia e hora
        $sqlCheck = "SELECT * FROM agendamentos WHERE data = ? AND hora = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param("ss", $data, $hora);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $mensagem_modal = "Já existe um agendamento marcado neste dia e horário!";
        } else {
            // Inserir agendamento
            $sqlInsert = "INSERT INTO agendamentos (id_usuario, id_pet, id_vacina, data, hora, observacoes)
                          VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("iiisss", $id_usuario, $id_pet, $id_vacina, $data, $hora, $observacao);
            if ($stmtInsert->execute()) {
                $mensagem_modal = "Agendamento realizado com sucesso!";
            } else {
                $mensagem_modal = "Erro ao agendar: " . $stmtInsert->error;
            }
            $stmtInsert->close();
        }
        $stmtCheck->close();
    } else {
        $mensagem_modal = "Preencha todos os campos obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agendamento de Vacina - VacinaPets</title>
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
        max-width: 600px;
        margin: 2rem auto;
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    form label {
        display: block;
        margin-top: 1rem;
        font-weight: bold;
    }
    form select, form input, form textarea {
        width: 100%;
        padding: 0.5rem;
        margin-top: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    form textarea {
        resize: vertical;
        min-height: 80px;
    }
    button {
        margin-top: 1.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        background: #4CAF50;
        color: white;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #45a049;
    }
    /* Modal */
    #modal {
        position: fixed;
        top:0; left:0; right:0; bottom:0;
        background: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 100;
    }
    #modal div {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        max-width: 400px;
        text-align: center;
    }
    #modal button {
        margin-top: 1rem;
    }
</style>
<script>
    const vacinas = <?php echo json_encode($vacinas); ?>;

    function atualizarVacinas() {
        const petSelect = document.getElementById('pet');
        const vacinaSelect = document.getElementById('vacina');
        const especiePet = petSelect.selectedOptions[0].dataset.especie;

        vacinaSelect.innerHTML = '';

        vacinas.forEach(v => {
            if (v.especie === especiePet) {
                let option = document.createElement('option');
                option.value = v.id_vacina;
                option.textContent = v.nome;
                vacinaSelect.appendChild(option);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        atualizarVacinas();
        document.getElementById('pet').addEventListener('change', atualizarVacinas);
    });
</script>
</head>
<body>
<header>
    <h1>Agendamento de Vacina</h1>
</header>
<main>

    <form method="POST">
        <label for="pet">Selecione o Pet:</label>
        <select name="pet" id="pet" required>
            <?php foreach($pets as $p): ?>
                <option value="<?= $p['id'] ?>" data-especie="<?= htmlspecialchars($p['especie']) ?>">
                    <?= htmlspecialchars($p['nome']) ?> (<?= htmlspecialchars($p['especie']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="vacina">Selecione a Vacina:</label>
        <select name="vacina" id="vacina" required></select>

        <label for="data">Data:</label>
        <input type="date" name="data" id="data" required min="<?= date('Y-m-d') ?>">

        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora" required>

        <label for="observacao">Observações:</label>
        <textarea name="observacao" id="observacao" placeholder="Ex.: alergias, instruções especiais"></textarea>

        <button type="submit">Agendar Vacina</button>
    </form>
</main>

<!-- Modal -->
<?php if(!empty($mensagem_modal)): ?>
<div id="modal">
    <div>
        <p><?= htmlspecialchars($mensagem_modal) ?></p>
        <button onclick="document.getElementById('modal').style.display='none'">Fechar</button>
    </div>
</div>
<?php endif; ?>

</body>
</html>
