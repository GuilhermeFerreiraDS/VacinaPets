<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetVax - Agendamento de Vacinação</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="modal.css">
   
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <i class="fas fa-paw"></i>
                <h1>PetVax</h1>
            </div>
            <p>Agendamento de Vacinação para Seu Pet</p>
        </div>
    </header>
    
    <div class="container">
        <section class="hero">
            <h2>Proteja Quem Você Ama</h2>
            <p>Agende agora a vacinação do seu pet de forma rápida, segura e com profissionais especializados. Garanta a saúde do seu melhor amigo!</p>
            <button class="btn" id="openModal">
                <i class="fas fa-calendar-check"></i> Agendar Agora
            </button>
        </section>
    </div>
    
    <!-- Modal -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <button class="modal-close" id="closeModal">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="modal-header">
                <h2>Agendar Vacinação</h2>
                <p>Preencha os dados abaixo para agendar a vacinação do seu pet</p>
            </div>
            
            <form id="appointmentForm">
                <div class="form-group">
                    <label for="petName">Nome do Pet</label>
                    <input type="text" id="petName" class="form-control" placeholder="Ex: Rex, Luna, Thor" required>
                </div>
                
                <div class="form-group">
                    <label for="petType">Tipo de Animal</label>
                    <select id="petType" class="form-select" required>
                        <option value="">Selecione...</option>
                        <option value="dog">Cachorro</option>
                        <option value="cat">Gato</option>
                        <option value="other">Outro</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="vaccineType">Tipo de Vacina</label>
                    <select id="vaccineType" class="form-select" required>
                        <option value="">Selecione...</option>
                        <option value="v8v10">V8 ou V10</option>
                        <option value="antirabica">Antirrábica</option>
                        <option value="giardia">Giardia</option>
                        <option value="leishmaniose">Leishmaniose</option>
                        <option value="gripe">Gripe Canina</option>
                        <option value="multiple">Vacina Múltipla (Felina)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="appointmentDate">Data Desejada</label>
                    <input type="date" id="appointmentDate" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="ownerName">Seu Nome</label>
                    <input type="text" id="ownerName" class="form-control" placeholder="Seu nome completo" required>
                </div>
                
                <div class="form-group">
                    <label for="ownerPhone">Telefone</label>
                    <input type="tel" id="ownerPhone" class="form-control" placeholder="(11) 99999-9999" required>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn-modal">
                        <i class="fas fa-paper-plane"></i> Confirmar Agendamento
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <div class="footer-content">
                <p><i class="fas fa-paw"></i> PetVax - Vacinação Animal</p>
                <p>Email: contato@petvax.com.br | Tel: (11) 9999-9999</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
                <p>&copy; 2023 PetVax - Todos os direitos reservados</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Modal functionality
        const modalOverlay = document.getElementById('modalOverlay');
        const openModalBtn = document.getElementById('openModal');
        const closeModalBtn = document.getElementById('closeModal');
        const appointmentForm = document.getElementById('appointmentForm');
        
        // Open modal
        openModalBtn.addEventListener('click', () => {
            modalOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
        
        // Close modal
        closeModalBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
            document.body.style.overflow = 'auto'; // Enable scrolling
        });
        
        // Close modal when clicking outside
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Form submission
        appointmentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Get form values
            const petName = document.getElementById('petName').value;
            const vaccineType = document.getElementById('vaccineType').value;
            
            // Show success message (in a real application, you would send data to a server)
            alert(`Agendamento realizado com sucesso para ${petName}!\nVacina: ${getVaccineName(vaccineType)}`);
            
            // Close modal
            modalOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
            
            // Reset form
            appointmentForm.reset();
        });
        
        // Helper function to get vaccine name
        function getVaccineName(value) {
            const vaccines = {
                'v8v10': 'V8 ou V10',
                'antirabica': 'Antirrábica',
                'giardia': 'Giardia',
                'leishmaniose': 'Leishmaniose',
                'gripe': 'Gripe Canina',
                'multiple': 'Vacina Múltipla (Felina)'
            };
            return vaccines[value] || 'Vacina';
        }
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('appointmentDate').setAttribute('min', today);
    </script>
</body>
</html>