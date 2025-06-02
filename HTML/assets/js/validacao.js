function validarFormulario() {
    const nome = document.getElementById("nome");
    const email = document.getElementById("email");
    const senha = document.getElementById("senha");
    const confirmarSenha = document.getElementById("confirmarSenha");
    const mensagemErro = document.getElementById("mensagemErro");   
    let erros = []; 
    [nome, email, senha, confirmarSenha].forEach(campo => campo.style.border = ""); 
    if (!nome.value.trim()) {
        erros.push("O nome está vazio.");
        nome.style.border = "2px solid red";
    }
    if (!email.value.trim()) {
        erros.push("O email está vazio.");
        email.style.border = "2px solid red";
    }
    if (!senha.value.trim()) {
        erros.push("A senha está vazia.");
        senha.style.border = "2px solid red";
    }
    if (!confirmarSenha.value.trim()) {
        erros.push("A confirmação de senha está vazia.");
        confirmarSenha.style.border = "2px solid red";
    }
    if (senha.value !== confirmarSenha.value) {
        erros.push("As senhas não coincidem.");
        senha.style.border = "2px solid red";
        confirmarSenha.style.border = "2px solid red";
    }   
    if (erros.length > 0) {
        mensagemErro.innerHTML = erros.join("<br>");
        return false;
    }   
    return true;
}
