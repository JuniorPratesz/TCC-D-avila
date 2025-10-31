<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro - MERCADO D'AVILA</title>
   <meta name="viewpord" content="with=device-width, initial-scale=1">
  <link rel="icon" href="imagens/mc.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #fffaf5;
      font-family: 'Poppins', sans-serif;
    }

    .cadastro-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .cadastro-card {
      background-color: white;
      border: 1px solid #ffdbb3;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 40px;
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    .cadastro-card h2 {
      color: #ff7b00;
      font-weight: 600;
      margin-bottom: 30px;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-laranja {
      background-color: #ff7b00;
      color: white;
      border: none;
      transition: 0.3s;
      width: 100%;
    }

    .btn-laranja:hover {
      background-color: #e66a00;
      color: white;
    }

    a {
      color: #ff7b00;
      text-decoration: none;
      font-weight: 500;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="cadastro-container">
    <div class="cadastro-card">
      <img src="imagens/logo.png" alt="Logo" style="width:240px;height:100px; margin-bottom:20px;">
      <h2><i class="bi bi-person-plus"></i> Cadastro</h2>

      <form method="post" action="cadastro_salvar.php">
        <div class="mb-3 text-start">
          <label class="form-label">Nome</label>
          <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="mb-4 text-start">
          <label class="form-label">Confirmar Senha</label>
          <input type="password" name="confirmar" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-laranja"><i class="bi bi-check-circle"></i> Cadastrar</button>
      </form>

      <hr>
      <p class="mt-2">Já tem uma conta?<br>
        <a href="login.php"><i class="bi bi-box-arrow-in-right"></i> Fazer login</a>
      </p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
