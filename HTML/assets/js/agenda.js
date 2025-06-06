// Lê o parâmetro 'local' da URL
const urlParams = new URLSearchParams(window.location.search); //
const localParam = urlParams.get('local'); //

// Mapeia os códigos dos locais para nomes legíveis
const nomesLocais = { //
  'vila-olimpia': 'Barbearia Vila Olímpia', //
  'itaim-bibi': 'Barbearia Itaim Bibi', //
  'moema': 'Barbearia Moema', //
  'higienopolis': 'Barbearia Higienópolis' //
};

// Define o nome no <h1>
const localTitle = document.getElementById('localTitle'); //
if (localParam && nomesLocais[localParam]) { //
  localTitle.textContent = `Agendamento - ${nomesLocais[localParam]}`; //
} else {
  localTitle.textContent = "Barbearia não identificada"; //
}

// Código do calendário
document.addEventListener('DOMContentLoaded', function () {
  const scheduleSection = document.getElementById("schedule"); //
  const confirmButton = document.getElementById("confirmButton"); //
  const confirmationSection = document.getElementById("confirmation"); //
  const confirmationMessage = document.getElementById("confirmationMessage"); //

  const daysContainer = document.querySelector('.calendar'); //
  const slots = document.querySelectorAll('.slot'); //
  const today = new Date(); //
  const currentYear = today.getFullYear(); //
  const currentMonth = today.getMonth(); // Mês atual (0-11)

  let selectedDay = null; //
  let selectedSlot = null; //

  // Criar dinamicamente os dias do mês atual
  function renderDays() {
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1); //
    const lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0); //
    const firstWeekday = firstDayOfMonth.getDay(); // 0 (domingo) a 6 (sábado)
    const daysInMonth = lastDayOfMonth.getDate(); //

    // Limpa os dias existentes (exceto os headers)
    const headers = Array.from(daysContainer.children).slice(0, 7); //
    daysContainer.innerHTML = ''; //
    headers.forEach(header => daysContainer.appendChild(header)); //

    // Adiciona os elementos vazios antes do primeiro dia
    for (let i = 0; i < firstWeekday; i++) { //
      const empty = document.createElement("div"); //
      empty.classList.add("empty"); //
      daysContainer.appendChild(empty); //
    }

    for (let i = 1; i <= daysInMonth; i++) { //
      const date = new Date(currentYear, currentMonth, i); //
      const dayOfWeek = date.getDay(); // 0 = domingo
      const isSunday = dayOfWeek === 0; //
      const isPast = date < new Date(today.getFullYear(), today.getMonth(), today.getDate()); //

      const dayElement = document.createElement("div"); //
      dayElement.classList.add("day"); //
      dayElement.textContent = i; //

      if (isPast || isSunday) { //
        dayElement.classList.add("disabled"); //
      } else {
        dayElement.addEventListener("click", () => { //
          document.querySelectorAll(".day").forEach(d => d.classList.remove("selected")); //
          dayElement.classList.add("selected"); //
          selectedDay = i; //
          scheduleSection.style.display = "block"; //
          confirmButton.style.display = "block"; //
          confirmationSection.style.display = "none"; //
        });
      }

      daysContainer.appendChild(dayElement); //
    }
  }
  
  // Seleção de horários
  slots.forEach(slot => { //
    slot.addEventListener("click", () => { //
      slots.forEach(s => s.classList.remove("selected-slot")); //
      slot.classList.add("selected-slot"); //
      selectedSlot = slot.textContent; //
    });
  });

  // Confirmação
  confirmButton.addEventListener("click", () => { //
    if (selectedDay && selectedSlot) { //
      const dataCompleta = new Date(currentYear, currentMonth, selectedDay); //
      const dataFormatada = dataCompleta.toISOString().split('T')[0]; //

      // **AJUSTE AQUI para um serviço padrão, ou adicione seleção de serviço na UI**
      const servicoIdPadrao = 1; // Exemplo: ID para "Corte de barba"

      fetch("/PHP/agendamento.php", { //
      method: "POST", //
      headers: { //
        "Content-Type": "application/json" //
      },
      body: JSON.stringify({ //
        local: localParam, //
        data: dataFormatada, //
        horario: selectedSlot, //
        servico_id: servicoIdPadrao // Use o ID do serviço aqui
      })
    })
    .then(response => response.json()) // Espera uma resposta JSON
    .then(data => { // `data` aqui é o objeto JSON retornado pelo PHP
      if (data.status === "success") {
        confirmationMessage.textContent = data.message || '✅ Seu pedido foi agendado para o dia (${selectedDay} às ${selectedSlot}'; // Exibe a mensagem de sucesso do PHP
        confirmationMessage.style.color = "#155724"; // Verde para sucesso
        confirmationSection.style.backgroundColor = "#e0ffe0"; // Fundo verde claro
        confirmationSection.style.borderColor = "#a5d6a7"; // Borda verde
        scheduleSection.style.display = "none"; //
        confirmButton.style.display = "none"; //
      } else {
        // Exibe a mensagem de erro do PHP (ex: horário ocupado)
        confirmationMessage.textContent = data.message || '❌ Erro ao agendar. Tente novamente.'; //
        confirmationMessage.style.color = "#721d1e"; // Vermelho para erro (cor do seu tema)
        confirmationSection.style.backgroundColor = "#ffe0e0"; // Fundo vermelho claro
        confirmationSection.style.borderColor = "#d86262"; // Borda vermelha
      }
      confirmationSection.style.display = "block"; //
    })
    .catch(error => {
      console.error("Erro na requisição:", error);
      confirmationMessage.textContent = '✅ Seu pedido foi agendado.'; //
      confirmationMessage.style.color = "#721d1e";
      confirmationSection.style.backgroundColor = "#ffe0e0";
      confirmationSection.style.borderColor = "#d86262";
      confirmationSection.style.display = "block"; //
    });
    } else {
      alert("Por favor, selecione um dia e um horário antes de confirmar."); //
    }
  });

  renderDays(); // Inicializa o calendário
}); 