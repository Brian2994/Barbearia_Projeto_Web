// Lê o parâmetro 'local' da URL
const urlParams = new URLSearchParams(window.location.search);
const localParam = urlParams.get('local');

// Mapeia os códigos dos locais para nomes legíveis
const nomesLocais = {
  'vila-olimpia': 'Barbearia Vila Olímpia',
  'itaim-bibi': 'Barbearia Itaim Bibi',
  'moema': 'Barbearia Moema',
  'higienopolis': 'Barbearia Higienópolis'
};

// Define o nome no <h1>
const localTitle = document.getElementById('localTitle');
if (localParam && nomesLocais[localParam]) {
  localTitle.textContent = `Agendamento - ${nomesLocais[localParam]}`;
} else {
  localTitle.textContent = "Barbearia não identificada";
}

// Código do calendário
document.addEventListener('DOMContentLoaded', function () {
  const scheduleSection = document.getElementById("schedule");
  const confirmButton = document.getElementById("confirmButton");
  const confirmationSection = document.getElementById("confirmation");
  const confirmationMessage = document.getElementById("confirmationMessage");

  const daysContainer = document.querySelector('.calendar');
  const slots = document.querySelectorAll('.slot');
  const today = new Date();
  const currentYear = today.getFullYear();
  const currentMonth = today.getMonth(); // Mês atual (0-11)

  let selectedDay = null;
  let selectedSlot = null;

  // Criar dinamicamente os dias do mês atual
  function renderDays() {
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1);
    const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
    const firstWeekday = firstDayOfMonth.getDay(); // 0 (domingo) a 6 (sábado)
    const daysInMonth = lastDayOfMonth.getDate();

    // Limpa os dias existentes (exceto os headers)
    const headers = Array.from(daysContainer.children).slice(0, 7);
    daysContainer.innerHTML = '';
    headers.forEach(header => daysContainer.appendChild(header));

    // Adiciona os elementos vazios antes do primeiro dia
    for (let i = 0; i < firstWeekday; i++) {
      const empty = document.createElement("div");
      empty.classList.add("empty");
      daysContainer.appendChild(empty);
    }

    for (let i = 1; i <= daysInMonth; i++) {
      const date = new Date(currentYear, currentMonth, i);
      const dayOfWeek = date.getDay(); // 0 = domingo
      const isSunday = dayOfWeek === 0;
      const isPast = date < new Date(today.getFullYear(), today.getMonth(), today.getDate());

      const dayElement = document.createElement("div");
      dayElement.classList.add("day");
      dayElement.textContent = i;

      if (isPast || isSunday) {
        dayElement.classList.add("disabled");
      } else {
        dayElement.addEventListener("click", () => {
          document.querySelectorAll(".day").forEach(d => d.classList.remove("selected"));
          dayElement.classList.add("selected");
          selectedDay = i;
          scheduleSection.style.display = "block";
          confirmButton.style.display = "block";
          confirmationSection.style.display = "none";
        });
      }

      daysContainer.appendChild(dayElement);
    }
  }

  // Seleção de horários
  slots.forEach(slot => {
    slot.addEventListener("click", () => {
      slots.forEach(s => s.classList.remove("selected-slot"));
      slot.classList.add("selected-slot");
      selectedSlot = slot.textContent;
    });
  });

  // Confirmação
  confirmButton.addEventListener("click", () => {
    if (selectedDay && selectedSlot) {
      const dataCompleta = new Date(currentYear, currentMonth, selectedDay);
      const dataFormatada = dataCompleta.toISOString().split('T')[0];
      fetch("/PHP/agendamento.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        local: localParam,
        data: dataFormatada,
        horario: selectedSlot,
        servico_id: 1
      })
    })
      .then(response => response.text())
      .then(mensagem =>{
      confirmationMessage.textContent = `✅ Seu pedido foi agendado para o dia ${selectedDay} às ${selectedSlot}`;
      confirmationSection.style.display = "block";
      scheduleSection.style.display = "none";
      confirmButton.style.display = "none";
      })
      .catch(error => {
        confirmationMessage.textContent = '❌ Erro ao agendar. Tente novamente.';
        confirmationSection.style.display = "block";
      });
    } else {
      alert("Por favor, selecione um dia e um horário antes de confirmar.");
    }
  });

  renderDays(); // Inicializa o calendário
});
