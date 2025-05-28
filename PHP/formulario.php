<?php
session_start();
?>

<!--HTML na mesma página -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro e Login</title>
  <link rel="stylesheet" href="/HTML/assets/css/formulario.css">
</head>

<body>
  <!-- Formulário de Agendamento-->
  <form action="/PHP/agendamento.php" method="POST" id="agendamentoForm" class="form-container">
    <label for="servico_id">Serviço:</label>
    <select name="servico_id" id="servico_id" required>
      <option value="1">Corte de barba</option>
      <option value="2">Corte de cabelo </option>
      <option value="3">Higiene e cuidados</option>
      <option value="4">Corte e barba</option>
    </select>
    <label for="data">Data:</label>
    <input type="date" name="data" id="data" required>
    <label for="horario">Horário:</label>
    <input type="time" name="horario" id="horario" required>
    <label for="plano_id">Plano:</label>
    <select name="plano_id" id="plano_id">
      <option value="">Nenhum</option>
      <option value="1">Plano Corte de Cabelo Mensal</option>
      <option value="2">Plano Corte de Barba Mensal</option>
      <option value="3">Plano Luxo Mensal</option>  
    </select>
    <button type="submit">Confirmar Agendamento</button>
  </form>
  
  <!-- Formulário de Cadastro -->
  <form action="/PHP/cadastro.php" onsubmit="return validarCadastro()" method="POST" id="cadastroForm" class="form-container">
    <h2>Cadastro</h2>
    <input type="text" name="nome" placeholder="Nome completo" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <input type="password" name="confirmar_senha" placeholder="Confirmar senha" required>
    <button type="submit">Cadastrar</button>
    <p id = "erroCadastro" style="color: red;"></p>
    <div class="switch-link" onclick="mostrarLogin()">Já tem uma conta? Faça login</div>
  </form>

  <!-- Formulário de Login -->
  <form action="/PHP/login.php" method="POST" id="loginForm" class="form-container active">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <p style = "color: red;"></p>
    <!-- recuperação de senha -->
    <div class="password-recovery">
      <a href="recuperarsenha.php">Esqueceu sua senha?</a>
    </div>
    <!-- cadastro de usuario -->
    <div class="switch-link" onclick="mostrarCadastro()">
      Ainda não tem uma conta? Cadastre-se
    </div>
  </form>

  <!-- Arquivo JS externo -->
  <script src="/HTML/assets/js/script_formulario.js"></script>

</body>

</html>