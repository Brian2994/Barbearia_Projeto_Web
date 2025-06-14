<?php
session_start();
?>

<!-- Formulário HTML na mesma página -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Agendamento</title>
    <link rel="stylesheet" href="/HTML/assets/css/agenda.css" />
</head>

<body>
    <main class="main-container">
        <!-- Calendário -->
        <section class="calendar-container">
            <h1 id="localTitle">Carregando barbearia...</h1>
            <h1>Selecione sua cita:</h1>
            <div class="calendar">
                <!-- Nomes dos días -->
                <div class="day-header">Domingo</div>
                <div class="day-header">Segunda</div>
                <div class="day-header">Terça</div>
                <div class="day-header">Quarta</div>
                <div class="day-header">Quinta</div>
                <div class="day-header">Sexta</div>
                <div class="day-header">Sábado</div>

                <!-- Começa no día correto -->
                <div class="empty"></div>
                <div class="empty"></div>
                <!-- Días -->
                <div class="day">1</div>
                <div class="day">2</div>
                <div class="day">3</div>
                <div class="day">4</div>
                <div class="day">5</div>
                <div class="day">6</div>
                <div class="day">7</div>
                <div class="day">8</div>
                <div class="day">9</div>
                <div class="day">10</div>
                <div class="day">11</div>
                <div class="day">12</div>
                <div class="day">13</div>
                <div class="day">14</div>
                <div class="day">15</div>
                <div class="day">16</div>
                <div class="day">17</div>
                <div class="day">18</div>
                <div class="day">19</div>
                <div class="day">20</div>
                <div class="day">21</div>
                <div class="day">22</div>
                <div class="day">23</div>
                <div class="day">24</div>
                <div class="day">25</div>
                <div class="day">26</div>
                <div class="day">27</div>
                <div class="day">28</div>
                <div class="day">29</div>
                <div class="day">30</div>
            </div>
        </section>

        <!-- Horários -->
        <section class="schedule" id="schedule">
            <h2>Selecione um horario:</h2>
            <button class="slot">09:00</button>
            <button class="slot">10:00</button>
            <button class="slot">11:00</button>
            <button class="slot">12:00</button>
            <button class="slot">13:00</button>
            <button class="slot">14:00</button>
            <button class="slot">15:00</button>
            <button class="slot">16:00</button>
            <button class="slot">17:00</button>
            <button class="slot">18:00</button>
            <button class="slot">19:00</button>
            <button class="slot">20:00</button>
        </section>

        <!-- Botão confirmar -->
        <button id="confirmButton">Confirmar</button>

        <!-- Confirmação -->
        <section class="confirmation-container" id="confirmation">
            <h3>Confirmação do seu agendamento!</h3>
            <p id="confirmationMessage"></p>
        </section>
    </main>

    <script src="/HTML/assets/js/agenda.js"></script>
    <script src="/HTML/assets/js/agendamento.js"></script>
</body>

</html>