<?php
session_start();
include("../conexao.php"); // Conexão com o banco

// Verifica se usuário está logado
$logado = isset($_SESSION['id_usuario']);
$temPet = false;

// Se estiver logado, verifica se tem pet cadastrado
if ($logado) {
    $sql = "SELECT COUNT(*) AS total FROM pets WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION['id_usuario']);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $temPet = ($result['total'] > 0);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VacinaPets - Home</title>
    <link rel="stylesheet" href="index.css">
    <style>
        /* Modal estilizado */
        #loginModal,
        #petModal {
            display: none;
            /* escondido por padrão */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modalContent {
            background: #fff;
            padding: 20px;
            width: 300px;
            border-radius: 8px;
            text-align: center;
        }

        .modalContent a,
        .modalContent button {
            margin-top: 10px;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .modalContent a {
            background: #3498db;
            color: #fff;
            display: inline-block;
        }

        .modalContent button {
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
                    <li><a href="#" id="agendarBtn">Agendar Vacina</a></li>
                    <li><a href="#" id="historicoBtn">Histórico</a></li>
                    <li><a href="../artigos/artigos.html" id="agendarBtn">Artigos</a></li>
                    <li><a href="../maps/maps.html" id="#">Nossas Lojas</a></li>
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

    <!-- Modal Login Pet -->
    <div id="loginModal">
        <div class="modalContent">
            <h2>Você precisa estar logado para acessar o cadastro do pet</h2>
            <a href="../cadastro/index.php">Ir para Login</a>
            <br><br>
            <button onclick="document.getElementById('loginModal').style.display='none'">Fechar</button>
        </div>
    </div>

    <!-- Modal Sem Pet -->
    <div id="petModal">
        <div class="modalContent">
            <h2>Você ainda não cadastrou um pet</h2>
            <a href="../cadastroPet/index.php">Cadastrar Pet</a>
            <br><br>
            <button onclick="document.getElementById('petModal').style.display='none'">Fechar</button>
        </div>
    </div>


    <section class="hero">
        <div class="container hero-content">
            <h2>Cuide do seu pet com agendamento de vacinação fácil</h2>
            <p>Agende as vacinas do seu animal de estimação de forma rápida, segura e sem complicações</p>
            <a href="../agendamento_vacina/agendamento.php" id="agendarHero" class="btn">Agendar Agora</a>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2>Nossos Serviços</h2>
                <p>Tudo que seu pet precisa para uma vida saudável e feliz</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">💉</div>
                    <h3>Vacinação Completa</h3>
                    <p>Todo o ciclo de vacinas necessário para cães e gatos em todas as fases da vida.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📅</div>
                    <h3>Agendamento Online</h3>
                    <p>Agende horários para vacinação sem sair de casa, 24 horas por dia.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">📱</div>
                    <h3>Lembretes Automáticos</h3>
                    <p>Notificações por e-mail e SMS para não esquecer as datas de vacinação.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🏥</div>
                    <h3>Atendimento Veterinário</h3>
                    <p>Profissionais qualificados para aplicar as vacinas e orientar sobre cuidados.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-title">
                <h2>Como Funciona</h2>
                <p>Agendar a vacina do seu pet é simples e rápido</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Cadastre-se</h3>
                    <p>Faça seu cadastro informando os dados seus e do seu pet.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Agende</h3>
                    <p>Escolha a data, horário e local mais convenientes para você.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Compareça</h3>
                    <p>Leve seu pet no dia agendado para receber a vacinação.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Acompanhe</h3>
                    <p>Receba lembretes das próximas vacinas e mantenha a carteirinha em dia.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>O que dizem nossos clientes</h2>
                <p>Experiências reais de donos de pets que usam nosso serviço</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Adorei o serviço! Conseguir agendar a vacina da minha Luna sem sair de casa foi incrível. Chegando no local foi tudo muito rápido e organizado."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">A</div>
                        <div class="author-info">
                            <div class="author-name">Ana Silva</div>
                            <div class="author-pet">Tutora da Luna</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Sempre esquecia das datas de vacinação do Thor. Agora com os lembretes do PetVax, nunca mais perdi uma vacina. O aplicativo é super intuitivo!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">M</div>
                        <div class="author-info">
                            <div class="author-name">Marcos Oliveira</div>
                            <div class="author-pet">Tutor do Thor</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"Profissionais muito qualificados e atenciosos. Meu gato Simba é bastante arisco, mas conseguiram aplicar a vacina sem estressá-lo. Recomendo!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">C</div>
                        <div class="author-info">
                            <div class="author-name">Carla Santos</div>
                            <div class="author-pet">Tutora do Simba</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta" id="agendar">
        <div class="container">
            <h2>Pronto para proteger seu pet?</h2>
            <p>Agende agora a vacinação do seu animal de estimação e garanta uma vida longa e saudável para ele</p>
           <a href="../agendamento_vacina/agendamento.php" id="agendarCTA" class="btn btn-reverse">Fazer Agendamento</a>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>PetVax</h3>
                    <p>Oferecemos a melhor solução para agendamento de vacinação pet, com praticidade e cuidado que seu animal merece.</p>
                </div>
                <div class="footer-column">
                    <h3>Links Rápidos</h3>
                    <a href="#services">Serviços</a>
                    <a href="#how-it-works">Como Funciona</a>
                    <a href="#testimonials">Depoimentos</a>
                    <a href="#agendar">Agendar</a>
                </div>
                <div class="footer-column">
                    <h3>Contato</h3>
                    <p>contato@petvax.com.br</p>
                    <p>(11) 99999-9999</p>
                    <p>Av. Paulista, 1000 - São Paulo, SP</p>
                </div>
                <div class="footer-column">
                    <h3>Redes Sociais</h3>
                    <div class="social-links">
                        <a href="#" class="social-icon">f</a>
                        <a href="#" class="social-icon">i</a>
                        <a href="#" class="social-icon">t</a>
                        <a href="#" class="social-icon">y</a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 PetVax - Todos os direitos reservados</p>
            </div>
        </div>
    </footer>

    <script>
        // Variáveis vindas do PHP
        let logado = <?php echo $logado ? 'true' : 'false'; ?>;
        let temPet = <?php echo $temPet ? 'true' : 'false'; ?>;

        // Login Pet
        document.getElementById("loginPetLink").addEventListener("click", function(e) {
            e.preventDefault();
            if (logado) {
                window.location.href = "../cadastroPet/index.php";
            } else {
                document.getElementById('loginModal').style.display = 'flex';
            }
        });

        // Função de verificação
        function verificarPet(url) {
            if (!logado) {
                document.getElementById('loginModal').style.display = 'flex';
            } else if (!temPet) {
                document.getElementById('petModal').style.display = 'flex';
            } else {
                window.location.href = url;
            }
        }

        // Botões Agendar / Histórico / Hero / CTA
        document.getElementById("agendarBtn").addEventListener("click", function(e) {
            e.preventDefault();
            verificarPet("../agendamento_vacina/agendamento.php");
        });

        document.getElementById("historicoBtn").addEventListener("click", function(e) {
            e.preventDefault();
            verificarPet("../historico/historico.php");
        });

        // Novo: Botão do hero (Agendar Agora)
        document.getElementById("agendarHero").addEventListener("click", function(e) {
            e.preventDefault();
            verificarPet("../agendamento_vacina/agendamento.php");
        });

        // Novo: Botão CTA (Fazer Agendamento)
        document.getElementById("agendarCTA").addEventListener("click", function(e) {
            e.preventDefault();
            verificarPet("../agendamento_vacina/agendamento.php");
        });
    </script>


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

    <!-- Seção de Avaliação -->
    <section class="avaliacao-section">
        <div class="avaliacao-content">
            <h2 class="avaliacao-title">Avalie nosso serviço</h2>
            <p class="avaliacao-subtitle">Sua opinião é muito importante para nós</p>
            
            <div class="estrelas-container">
                <span class="estrela" data-value="1">☆</span>
                <span class="estrela" data-value="2">☆</span>
                <span class="estrela" data-value="3">☆</span>
                <span class="estrela" data-value="4">☆</span>
                <span class="estrela" data-value="5">☆</span>
            </div>
            
            <button class="btn-avaliar" onclick="abrirModal()">Enviar Avaliação</button>
            <p class="avaliacao-texto">Clique nas estrelas e depois em "Enviar Avaliação"</p>
        </div>
    </section>

    <!-- Modal de Avaliação -->
    <div id="modal-avaliacao" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="fecharModal()">&times;</span>
            <h3>Finalizar Avaliação</h3>
            
            <div class="avaliacao-selecionada">
                <p>Sua avaliação: <span id="nota-selecionada">0</span> estrelas</p>
                <div class="estrelas-modal">
                    <span class="estrela-modal" data-value="1">☆</span>
                    <span class="estrela-modal" data-value="2">☆</span>
                    <span class="estrela-modal" data-value="3">☆</span>
                    <span class="estrela-modal" data-value="4">☆</span>
                    <span class="estrela-modal" data-value="5">☆</span>
                </div>
            </div>
            
            <form id="form-avaliacao">
                <div class="form-group">
                    <label for="nome">Seu nome:</label>
                    <input type="text" id="nome" name="nome" required placeholder="Digite seu nome">
                </div>
                
                <div class="form-group">
                    <label for="comentario">Comentário (opcional):</label>
                    <textarea id="comentario" name="comentario" placeholder="Conte sua experiência..."></textarea>
                </div>
                
                <input type="hidden" id="nota" name="nota" value="0">
                
                <button type="submit" class="btn-enviar">Enviar Avaliação</button>
            </form>
        </div>
    </div>

    <!-- Dentro do modal-content, depois do h3 -->
<div id="mensagem-container"></div>

<!-- Adicione o loading spinner -->
<div class="loading" id="loading">
    <div class="spinner"></div>
    <p>Enviando avaliação...</p>
</div>

    <style>
        .avaliacao-section {
            width: 100%;
            height: 50vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            background-color: var(--cinza-claro);
        }

        .avaliacao-content {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        .avaliacao-title {
            font-size: 2rem;
            color: #333;
            margin-bottom: 10px;
        }

        .avaliacao-subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }

        .estrelas-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 30px 0;
        }

        .estrela {
            font-size: 3rem;
            cursor: pointer;
            color: #ddd;
            transition: all 0.3s ease;
        }

        .estrela:hover,
        .estrela.ativa {
            color: #ffc107;
            transform: scale(1.2);
        }

        .btn-avaliar {
            background: #667eea;
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 20px;
        }

        .btn-avaliar:hover {
            background: #5a6fd8;
        }

        .avaliacao-texto {
            margin-top: 15px;
            color: #666;
            font-size: 0.9rem;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 28px;
            cursor: pointer;
            color: #999;
        }

        .close-modal:hover {
            color: #333;
        }

        .avaliacao-selecionada {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .estrelas-modal {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 15px 0;
        }

        .estrela-modal {
            font-size: 2rem;
            cursor: pointer;
            color: #ddd;
            transition: color 0.3s ease;
        }

        .estrela-modal.ativa {
            color: #ffc107;
        }

        .estrela-modal:hover {
            color: #ffc107;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn-enviar {
            width: 100%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-enviar:hover {
            background: #5a6fd8;
        }

        .loading {
    display: none;
    text-align: center;
    margin: 10px 0;
}

.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #667eea;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 1s linear infinite;
    margin: 0 auto 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
    </style>

    <script>
       let notaSelecionada = 0;

// Elementos do DOM
const estrelas = document.querySelectorAll('.estrela');
const estrelasModal = document.querySelectorAll('.estrela-modal');
const modal = document.getElementById('modal-avaliacao');
const notaSelecionadaSpan = document.getElementById('nota-selecionada');
const notaInput = document.getElementById('nota');
const formAvaliacao = document.getElementById('form-avaliacao');
const mensagemContainer = document.getElementById('mensagem-container');
const loading = document.getElementById('loading');

// Sistema de estrelas principal
estrelas.forEach(estrela => {
    estrela.addEventListener('click', function() {
        notaSelecionada = parseInt(this.getAttribute('data-value'));
        atualizarEstrelas(estrelas, notaSelecionada);
    });

    // Efeito hover
    estrela.addEventListener('mouseover', function() {
        const valor = parseInt(this.getAttribute('data-value'));
        estrelas.forEach(e => {
            const eValor = parseInt(e.getAttribute('data-value'));
            if (eValor <= valor) {
                e.style.color = '#ffc107';
            }
        });
    });

    estrela.addEventListener('mouseout', function() {
        estrelas.forEach(e => {
            if (!e.classList.contains('ativa')) {
                e.style.color = '#ddd';
            }
        });
    });
});

// Sistema de estrelas do modal
estrelasModal.forEach(estrela => {
    estrela.addEventListener('click', function() {
        notaSelecionada = parseInt(this.getAttribute('data-value'));
        atualizarEstrelas(estrelasModal, notaSelecionada);
        atualizarFormulario();
    });

    // Efeito hover no modal
    estrela.addEventListener('mouseover', function() {
        const valor = parseInt(this.getAttribute('data-value'));
        estrelasModal.forEach(e => {
            const eValor = parseInt(e.getAttribute('data-value'));
            if (eValor <= valor) {
                e.style.color = '#ffc107';
            }
        });
    });

    estrela.addEventListener('mouseout', function() {
        estrelasModal.forEach(e => {
            if (!e.classList.contains('ativa')) {
                e.style.color = '#ddd';
            }
        });
    });
});

// Atualizar visual das estrelas
function atualizarEstrelas(estrelasArray, nota) {
    estrelasArray.forEach(estrela => {
        const valor = parseInt(estrela.getAttribute('data-value'));
        if (valor <= nota) {
            estrela.textContent = '⭐';
            estrela.classList.add('ativa');
        } else {
            estrela.textContent = '☆';
            estrela.classList.remove('ativa');
        }
    });
}

// Atualizar formulário
function atualizarFormulario() {
    notaInput.value = notaSelecionada;
    notaSelecionadaSpan.textContent = notaSelecionada;
}

// Abrir modal
function abrirModal() {
    if (notaSelecionada === 0) {
        mostrarMensagem('Por favor, selecione uma nota antes de enviar!', 'erro');
        return;
    }
    modal.style.display = 'block';
    atualizarEstrelas(estrelasModal, notaSelecionada);
    atualizarFormulario();
    // Limpar mensagens anteriores
    mensagemContainer.innerHTML = '';
}

// Fechar modal
function fecharModal() {
    modal.style.display = 'none';
}

// Fechar modal clicando fora
window.addEventListener('click', function(event) {
    if (event.target === modal) {
        fecharModal();
    }
});

// Mostrar mensagens
function mostrarMensagem(mensagem, tipo) {
    mensagemContainer.innerHTML = `<div class="mensagem ${tipo}">${mensagem}</div>`;
}

// Enviar formulário via AJAX
formAvaliacao.addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (notaSelecionada === 0) {
        mostrarMensagem('Por favor, selecione uma nota!', 'erro');
        return;
    }

    // Mostrar loading
    loading.style.display = 'block';
    mensagemContainer.innerHTML = '';

    // Coletar dados do formulário
    const formData = new FormData(this);

    // Enviar para o PHP
    fetch('salvar_avaliacao.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Esconder loading
        loading.style.display = 'none';
        
        if (data.status === 'success') {
            mostrarMensagem(data.message, 'sucesso');
            
            // Limpar formulário após sucesso
            setTimeout(() => {
                formAvaliacao.reset();
                notaSelecionada = 0;
                atualizarEstrelas(estrelas, 0);
                atualizarEstrelas(estrelasModal, 0);
                fecharModal();
            }, 2000);
        } else {
            mostrarMensagem(data.message, 'erro');
        }
    })
    .catch(error => {
        loading.style.display = 'none';
        mostrarMensagem('Erro ao enviar avaliação. Tente novamente.', 'erro');
        console.error('Erro:', error);
    });
});
    </script>

</body>

</html>