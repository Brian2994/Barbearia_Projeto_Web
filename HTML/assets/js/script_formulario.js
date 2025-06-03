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
