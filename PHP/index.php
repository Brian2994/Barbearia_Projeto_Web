<?php 
session_start();

?>

<!--HTML na mesma página -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbearia Company</title>
    <link rel="stylesheet" href="/HTML/assets/css/estilo.css">
</head>

<script>
    function toggleMenu() {
    const menu = document.getElementById('menu');
        menu.classList.toggle('show');
    }
    document.addEventListener('DOMContentLoaded', () => {
        const menu = document.getElementById('menu');
        const hamburger = document.querySelector('.hamburguer');
        document.querySelectorAll('.navbar a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.remove('show');
            });
        });
        document.addEventListener('click', function (e) {
            const menu = document.getElementById('menu');
            const hamburger = document.querySelector('.hamburguer');
            if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
                menu.classList.remove('show');
            }
        });
    });
    document.addEventListener('click', function(e) {
    const menu = document.getElementById('menu');
    const hamburger = document.querySelector('.hamburguer');
    if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
    menu.classList.remove('show');
}
});
</script>


<body>
    <!-- Página 1 -->
    <!-- Barra de Navegação Fixa -->
    <div class="nav-barra-fixa">
        <div class="container">
            <div class="topo">
                <a href="index.php" class="logo">
                    <img src="/HTML/assets/imagens/logo_barber_company.png" alt="Barbearia company logo" class="logo-img">
                </a>
                <div class="hamburguer" onclick="toggleMenu()">☰</div>
            </div>
            <nav class="navbar" id="menu">
                <ul>
                    <li><a href="agendamento.php">Agendar</a></li>
                    <li><a href="#sobre">Sobre Nós</a></li>
                    <li><a href="#servicos">Serviços</a></li>
                    <li><a href="#unidades">Unidades</a></li>
                    <li><a href="#planos">Planos</a></li>
                    <?php if (isset($_SESSION['usuario_nome'])): ?>
                        <li><span style="color: white;"><?= htmlspecialchars($_SESSION['usuario_nome']) ?></span></li> 
                        <li><a href="logout.php">Sair</a></li>
                    <?php else: ?>
                        <li><a href="formulario.php">Entrar</a></li>
                    <?php endif; ?> 

                </ul>
            </nav>
        </div>
    </div>

    <!-- Header visual (imagem + título + botão) -->
    <header class="header">
        <div class="conteudo">
            <div class="txt">
                <h1>Nós fornecemos um serviço<br>de primeira classe</h1>
                <div class="buttons">
                    <a href="agendamento.php">Agendar</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Página 2 -->
    <section id="sobre">
        <div class="container">
            <!-- Imagem do lado izquedo -->
            <div class="left">
                <img src="https://s4.gifyu.com/images/bpFBt.webp" alt="">
            </div>
            <!-- Titulo e descrição do lado direito -->
            <div class="right">
                <h1>Barbearia company</h1>
                <p>Barberia Company: Mais do que um simples corte, é uma experiência. Nossa missão é proporcionar a você
                    um momento de cuidado e transformação, seja no corte de cabelo, na barba, ou no cuidado completo com
                    higiene e bem-estar. Com um ambiente moderno e acolhedor, oferecemos serviços personalizados, feitos
                    sob medida para atender ao seu estilo e necessidades. Nossa equipe de profissionais experientes
                    garante que você saia com a sensação de estar renovado, confiante e com um visual impecável. Na
                    Barberia Company, cada detalhe é pensado para que você se sinta único. Porque aqui, você é o centro
                    das atenções!
                </p>
            </div>
        </div>
    </section>

    <!-- Página 3 -->
    <section id="servicos">
        <h2>Conheça nossos<br>
            <b>Serviços</b>
        </h2>

        <div class="servicos-container">
            <!-- Servico 1 -->
            <div class="servico">
                <a href="agendamento.php?servico=barba" style='text-decoration:none'>
                <img src="https://s4.gifyu.com/images/bpFBO.webp" alt="corte de barba">
                <h3>Corte de barba</h3>
                <p>Estilo clássico com acabamento preciso</p>
                </a>
            </div>

            <!-- Servico 2 -->
            <div class="servico">
                <a href="agendamento.php?servico=cabelo" style='text-decoration:none'>
                <img src="https://s4.gifyu.com/images/bpFJb.jpg" alt="corte de cabelo">
                <h3>Corte de cabelo</h3>
                <p>Visual moderno ou tradicional com atenção aos detalhes</p>
                </a>
            </div>

            <!-- Servico 3 -->
            <div class="servico">
                <a href="agendamento.php?servico=higiene_e_cuidados" style='text-decoration:none'>
                <img src="https://s4.gifyu.com/images/bpFOx.jpg" alt="higiene e cuidados">
                <h3>Higiene e cuidados</h3>
                <p>Limpeza profunda e produtos de alta qualidade para sua pele</p>
                </a>
            </div>

            <!-- Servico 4 -->
            <div class="servico">
                <a href="agendamento.php?servico=corte_e_barba" style='text-decoration:none'>
                <img src="https://s4.gifyu.com/images/bpFOb.jpg" alt="corte e barba">
                <h3>Corte e barba</h3>
                <p>Combo completo para um visual alinhado e marcante</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Página 4 -->
    <section id="unidades">
        <h2>Conheça nossas<br>
            <b>Unidades</b>
        </h2>

        <div class="unidades-container">
            <!-- Unidade 1 -->
            <div class="unidade">
                <img src="https://s4.gifyu.com/images/bpFOg.webp" alt="Unidade Vila Olímpia">
                <h3>VILA OLÍMPIA</h3>
                <p>
                    Rua Quatá, 123 - Vila Olímpia<br>
                    Estacionamentos de veículos<br>
                    (11) 5254-8546<br>
                    <strong>Horários de funcionamento:</strong><br>
                    Segunda a sexta: 9h às 20h<br>
                    Sábado: 9h às 18h
                </p>
            </div>

            <!-- Unidade 2 -->
            <div class="unidade">
                <img src="https://s4.gifyu.com/images/bpFGJ.jpg " alt="Unidade Itaim Bibi">
                <h3>ITAIM BIBI</h3>
                <p>
                    Rua Tabapuã, 321 - Itaim Bibi<br>
                    Estacionamentos de veículos<br>
                    (11) 5254-8546<br>
                    <strong>Horários de funcionamento:</strong><br>
                    Segunda a sexta: 9h às 20h<br>
                    Sábado: 9h às 18h
                </p>
            </div>

            <!-- Unidade 3 -->
            <div class="unidade">
                <img src="https://s4.gifyu.com/images/bpFOl.jpg" alt="Unidade Moema">
                <h3>MOEMA</h3>
                <p>
                    Avenida Rouxinol, 123 - Moema<br>
                    Estacionamentos de veículos<br>
                    (11) 5254-8546<br>
                    <strong>Horários de funcionamento:</strong><br>
                    Segunda a sexta: 9h às 20h<br>
                    Sábado: 9h às 18h
                </p>
            </div>

            <!-- Unidade 4 -->
            <div class="unidade">
                <img src="https://s4.gifyu.com/images/bpFOQ.jpg" alt="Unidade Oscar Freire">
                <h3>OSCAR FREIRE</h3>
                <p>
                    Avenida Angélica, 321 - Higienópolis<br>
                    Estacionamentos de veículos<br>
                    (11) 5254-8546<br>
                    <strong>Horários de funcionamento:</strong><br>
                    Segunda a sexta: 9h às 20h<br>
                    Sábado: 9h às 18h
                </p>
            </div>
        </div>
    </section>

    <!-- Página 5 -->
    <section id="planos">
        <h2>Conheça nossos<br>
            <b>Planos</b>
        </h2>

        <div class="planos-container">
            <!-- Plano 1 -->
            <div class="plano">
                <img src="/HTML/assets/imagens/Plano_barba.jpeg" alt="corte de barba">
                <h3>Corte de barba</h3>
                <ul>
                    <li>4 sessões de barba por mês</li>
                    <li>Design e alinhamento inclusos</li>
                    <li>Agendamento online</li>
                </ul>
                <p class="preco-plano"><strong>R$59,90/mês</strong></p>
            </div>

            <!-- Plano 2 -->
            <div class="plano">
                <img src="/HTML/assets/imagens/Plano_cabelo.jpeg" alt="corte de cabelo">
                <h3>Corte de cabelo</h3>
                <ul>
                    <li>4 cortes de cabelo por mês</li>
                    <li>Estilo personalizados</li>
                    <li>Agendamento online</li>
                </ul>
                <p class="preco-plano"><strong>R$79,90/mês</strong></p>
            </div>

            <!-- Plano 3 -->
            <div class="plano">
                <img src="/HTML/assets/imagens/Plano_premium.jpeg" alt="higiene e cuidados">
                <h3>Higiene e cuidados</h3>
                <ul>
                    <li>4 cortes de cabelo + 4 sessões de barba por mês</li>
                    <li>Produtos exclusivos inclusos</li>
                    <li>Prioridade no gendamento</li>
                </ul>
                <p class="preco-plano"><strong>R$129,90/mês</strong></p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 - Todos os direitos reservados.</p>
    </footer>

    <script src="/Barbearia_Projeto_Web/assets/js/script.js"></script>
</body>

</html>