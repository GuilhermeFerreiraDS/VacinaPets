<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VacinaPets - Home</title>
<link rel="stylesheet" href="index.css">
<style>
  /* Modal estilizado */
  #loginModal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 9999;
  }
  #loginModalContent {
      background: #fff;
      padding: 20px;
      width: 300px;
      border-radius: 8px;
      text-align: center;
  }
  #loginModalContent a, #loginModalContent button {
      margin-top: 10px;
      padding: 8px 12px;
      border-radius: 5px;
      text-decoration: none;
      border: none;
      cursor: pointer;
  }
  #loginModalContent a {
      background: #3498db;
      color: #fff;
      display: inline-block;
  }
  #loginModalContent button {
      background: #e74c3c;
      color: #fff;
  }
</style>
</head>
<body>
<header>
    <div class="container header-content">
        <div class="logo">
            <span class="logo-icon">🐾</span>
            <h1>VacinaPets</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="../agendamento_vacina/agendamento.php">Agendar Vacina</a></li>
                <li><a href="../historico/historico.php">Histórico</a></li>
                <li class="login-separator">
                    <ul style="display:flex; list-style:none;">
                        <li class="login-item"><a href="../cadastro/index.php">Login User</a></li>
                        <li class="login-item" style="margin-left:15px;">
                            <a href="#" id="loginPetLink">Login Pet</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>

<!-- Modal -->
<div id="loginModal">
    <div id="loginModalContent">
        <h2>Você precisa estar logado para acessar o cadastro do pet</h2>
        <a href="../cadastro/index.php">Ir para Login</a>
        <br><br>
        <button onclick="document.getElementById('loginModal').style.display='none'">Fechar</button>
    </div>
</div>

<script>
document.getElementById("loginPetLink").addEventListener("click", function(e) {
    e.preventDefault(); // evita clique normal
    <?php if (isset($_SESSION['usuario'])): ?>
        // Usuário logado → vai para cadastroPet
        window.location.href = "../cadastroPet/index.php";
    <?php else: ?>
        // Usuário não logado → abre modal toda vez
        document.getElementById('loginModal').style.display = 'flex';
    <?php endif; ?>
});
</script>

<section class="hero">
    <div class="container hero-content">
        <h2>Cuide do seu pet com agendamento de vacinação fácil</h2>
        <p>Agende as vacinas do seu animal de estimação de forma rápida, segura e sem complicações</p>
        <a href="../agendamento_vacina/agendamento.php" class="btn">Agendar Agora</a>
    </div>
</section>

<!-- Modal de Login Pet -->
<div id="loginModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:flex; justify-content:center; align-items:center;">
  <div style="background:#fff; padding:20px; width:300px; border-radius:8px; text-align:center;">
    <h2>Você precisa estar logado</h2>
    <a href="../cadastro/index.php" style="display:inline-block; margin-top:10px; padding:8px 12px; background:#3498db; color:#fff; border-radius:5px; text-decoration:none;">Ir para Login</a>
    <br><br>
    <button onclick="document.getElementById('loginModal').style.display='none'" style="padding:8px 12px; background:#e74c3c; color:#fff; border:none; border-radius:5px; cursor:pointer;">Fechar</button>
  </div>
</div>

<script>
document.getElementById("loginPetLink").addEventListener("click", function(e) {
    e.preventDefault(); // bloqueia o clique padrão
    <?php if (!isset($_SESSION['usuario'])): ?>
        // Não está logado → abre modal
        document.getElementById('loginModal').style.display = 'flex';
    <?php else: ?>
        // Está logado → redireciona para cadastroPet
        window.location.href = "../cadastroPet/index.php";
    <?php endif; ?>
});
</script>

<!-- Aqui você mantém todo o conteúdo da home: services, how-it-works, testimonials, cta e footer -->
<!-- Seu conteúdo existente continua aqui sem alterações -->

<section class="services" id="services">
    <!-- ... seu conteúdo ... -->
</section>

<section class="how-it-works" id="how-it-works">
    <!-- ... seu conteúdo ... -->
</section>

<section class="testimonials" id="testimonials">
    <!-- ... seu conteúdo ... -->
</section>

<section class="cta" id="agendar">
    <!-- ... seu conteúdo ... -->
</section>

<footer id="contact">
    <!-- ... seu conteúdo ... -->
</footer>

<?php
// Processamento do formulário de agendamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $pet = htmlspecialchars($_POST['pet']);
    $data = htmlspecialchars($_POST['data']);
    
    echo "<script>alert('Agendamento recebido! Entraremos em contato para confirmar. Obrigado, $nome!');</script>";
}
?>
</body>
</html>
