document.getElementById('confirmButton').addEventListener('click', function () {
    // Pega os dados dos campos
    const servico_id = document.getElementById('servico_id').value;
    const data = document.getElementById('data').value;
    const horario = document.getElementById('horario').value;
    const plano_id = document.getElementById('plano_id').value;
    const local = document.getElementById('local').value;

    // Cria um objeto com os dados
    const agendamentoData = {
        servico_id: servico_id,
        data: data,
        horario: horario,
        plano_id: plano_id,
        local: local
    };

    // Valida se todos os campos obrigatórios estão preenchidos
    if (!servico_id || !data || !horario || !local) {
        alert("Por favor, preencha todos os campos.");
        return;
    }

    // Envia os dados para o PHP usando Fetch (AJAX)
    fetch('/PHP/agendamento.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(agendamentoData) // Envia os dados em formato JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Agendamento realizado com sucesso!");
            // Redireciona para outra página ou limpa o formulário
            window.location.href = '/index.php';
        } else {
            alert("Erro ao agendar. Tente novamente.");
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert("Houve um erro. Tente novamente.");
    });
});
