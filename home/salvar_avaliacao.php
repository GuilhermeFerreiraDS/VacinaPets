<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber dados do formulário
    $nome = trim($_POST['nome']);
    $nota = intval($_POST['nota']);
    $comentario = trim($_POST['comentario']);
    
    // Validações
    if (empty($nome)) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, digite seu nome!']);
        exit();
    }
    
    if ($nota < 1 || $nota > 5) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, selecione uma nota válida!']);
        exit();
    }
    
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root"; // seu usuário do MySQL
    $password = ""; // sua senha do MySQL
    $dbname = "vacinapets"; // nome do seu banco
    
    try {
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Verificar conexão
        if ($conn->connect_error) {
            throw new Exception("Falha na conexão: " . $conn->connect_error);
        }
        
        // Preparar e executar a query
        $sql = "INSERT INTO avaliacoes (nome_usuario, nota, comentario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Erro na preparação: " . $conn->error);
        }
        
        $stmt->bind_param("sis", $nome, $nota, $comentario);
        
        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success', 
                'message' => 'Avaliação enviada com sucesso! Obrigado!'
            ]);
        } else {
            throw new Exception("Erro ao executar: " . $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
        
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Erro no servidor: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Método não permitido!'
    ]);
}
?>