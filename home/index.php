<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VacinaPets - Agendamento de Vacinação</title>
    <link rel="stylesheet" href="index.css">
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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Agendar Vacina</a></li>
                    <li><a href="#">Histórico</a></li>
                    
                    <!-- Separador visual e os logins à direita -->
                    <li class="login-separator">
                        <ul style="display: flex; list-style: none;">
                            <li class="login-item"><a href="#user-login">Login User</a></li>
                            <li class="login-item" style="margin-left: 15px;"><a href="#pet-login">Login Pet</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <section class="hero">
    <div class="container hero-content">
        <h2>Cuide do seu pet com agendamento de vacinação fácil</h2>
        <p>Agende as vacinas do seu animal de estimação de forma rápida, segura e sem complicações</p>
        <a href="modal/modal.php" class="btn">Agendar Agora</a>
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
            <a href="#" class="btn btn-reverse">Fazer Agendamento</a>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>VacinaPets</h3>
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
                    <p>VacinaPets.com.br</p>
                    <p>(15) 32456742</p>
                    <p>Av. Paulista, 1005 - Tatui, SP</p>
                </div>
    
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 VacinaPets - Todos os direitos reservados</p>
            </div>
        </div>
    </footer>

    <?php
    // Processamento do formulário de agendamento
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = htmlspecialchars($_POST['nome']);
        $email = htmlspecialchars($_POST['email']);
        $telefone = htmlspecialchars($_POST['telefone']);
        $pet = htmlspecialchars($_POST['pet']);
        $data = htmlspecialchars($_POST['data']);
        
        // Aqui você normalmente salvaria no banco de dados ou enviaria por email
        // Por simplicidade, vamos apenas exibir uma mensagem
        echo "<script>alert('Agendamento recebido! Entraremos em contato para confirmar. Obrigado, $nome!');</script>";
    }
    ?>
</body>
</html>