function mostrarLogin() {
    document.getElementById("cadastroForm").classList.remove("active");
    document.getElementById("loginForm").classList.add("active");
  }
  
  function mostrarCadastro() {
    document.getElementById("loginForm").classList.remove("active");
    document.getElementById("cadastroForm").classList.add("active");
  }
  function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.classList.toggle('show');
}
    document.querySelectorAll('.navbar a').forEach(link => {
    link.addEventListener('click', () => {
    document.getElementById('menu').classList.remove('show');
    });
});
    document.addEventListener('click', function(e) {
    const menu = document.getElementById('menu');
    const hamburger = document.querySelector('.hamburguer');
    
    if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
    menu.classList.remove('show');
}
});
function validarCadastro() {
  const nome = document.getElementById('nome').value.trim();
  const email = document.getElementById('email').value.trim();
  const senha = document.getElementById('senha').value.trim();
  const erro = document.getElementById('erroCadastro');
  
  if (nome === '' || email === '' || senha === '') {

    erro.textContent = 'Por favor, preencha todos os campos que foram solicitados.';
    return  false;
  }

  return true
}
