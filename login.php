<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Loja Virtual</title>
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

    .login-container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .login-card {
      background-color: #fff;
      border: 1px solid #ffdbb3;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-card h2 {
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

  <div class="login-container">
    <div class="login-card">
      <h2><i class="bi bi-person-circle"></i> Login</h2>
      <form method="post" action="login_validar.php">
        <div class="mb-3 text-start">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
          <label class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-laranja mt-3"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>
      </form>
      <hr>
      <p class="mt-2">Ainda não tem conta?<br>
        <a href="cadastro.php"><i class="bi bi-person-plus"></i> Cadastre-se aqui</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
