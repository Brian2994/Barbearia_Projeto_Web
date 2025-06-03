let unidadeSelecionada = "";
let horarioSelecionado = "";
let servicoSelecionado = null;

document.getElementById("unidades").addEventListener("click", function(e) {
    if (e.target.tagName === "BUTTON") {
        unidadeSelecionada = e.target.textContent;
    }
});

document.getElementById("horarios").addEventListener("click", function(e) {
    if (e.target.tagName === "BUTTON") {
        horarioSelecionado = e.target.textContent;
    }
});

document.getElementById("confirmarAgendamento").addEventListener("click", async () => {
    const dataSelecionada = document.getElementById("dataAgendamento").value;

    if (!unidadeSelecionada || !horarioSelecionado || !dataSelecionada) {
        document.getElementById("mensagem").innerText = "Preencha todos os campos.";
        return;
    }

    const dados = new FormData();
    dados.append("unidade", unidadeSelecionada);
    dados.append("data", dataSelecionada);
    dados.append("hora", horarioSelecionado);

    const resposta = await fetch("agendamento.php", {
        method: "POST",
        body: dados
    }); 
    const texto = await resposta.text();
    document.getElementById("mensagem").innerText = texto;

document.querySelectorAll(".servico-btn").forEach(button => {
    button.addEventListener("click", () => {
        document.querySelectorAll(".servico-btn").forEach(btn => btn.classList.remove("selected"));
        button.classList.add("selected");
        servicoSelecionado = button.getAttribute("data-servico");
    });
});
});
