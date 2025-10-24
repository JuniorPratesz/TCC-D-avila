<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

// Limpa o carrinho após a compra
unset($_SESSION['carrinho']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Compra Finalizada - Loja Virtual</title>
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

    header {
      background-color: #ff7b00;
      color: white;
      padding: 15px 0;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .container {
      margin-top: 80px;
    }

    .confirm-card {
      background-color: white;
      border: 1px solid #ffdbb3;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 40px;
      text-align: center;
      max-width: 600px;
      margin: 0 auto;
    }

    .confirm-card i {
      font-size: 60px;
      color: #ff7b00;
      margin-bottom: 20px;
    }

    .pix-box {
      background-color: #fff4e5;
      border: 1px dashed #ff7b00;
      border-radius: 10px;
      padding: 15px;
      margin-top: 15px;
      font-size: 18px;
      color: #444;
    }

    .btn-laranja {
      background-color: #ff7b00;
      color: white;
      border: none;
      transition: 0.3s;
    }

    .btn-laranja:hover {
      background-color: #e66a00;
      color: white;
    }

    .footer {
      background-color: #ff7b00;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: 60px;
    }
  </style>
</head>
<body>

  <header class="text-center">
    <div class="container d-flex justify-content-between align-items-center">
      <h2 class="m-0"><i class="bi bi-bag-check"></i> Compra Finalizada</h2>
      <div>
        <span>Olá, <strong><?php echo $_SESSION['usuario']; ?></strong></span>
        <a href="index.php" class="btn btn-light btn-sm"><i class="bi bi-shop"></i> Voltar à Loja</a>
        <a href="sair.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="confirm-card">
      <i class="bi bi-check-circle-fill"></i>
      <h3 class="fw-bold mb-3">Compra finalizada com sucesso!</h3>
      <p class="text-muted">Obrigado por comprar conosco. Realize o pagamento via PIX abaixo:</p>

      <div class="pix-box">
        <strong><i class="bi bi-qr-code"></i> PIX:</strong>  
        <span id="pix-chave" class="fw-bold">55984272911</span>
        <br>
        <button class="btn btn-sm btn-laranja mt-2" onclick="copiarPix()">
          <i class="bi bi-clipboard"></i> Copiar Chave
        </button>
      </div>

      <a href="index.php" class="btn btn-laranja mt-4"><i class="bi bi-shop"></i> Voltar à Loja</a>
    </div>
  </div>

  <div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Minha Loja - Todos os direitos reservados.</p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script JS -->
  <script>
    function copiarPix() {
      const pix = document.getElementById("pix-chave").innerText;
      navigator.clipboard.writeText(pix).then(() => {
        alert("Chave PIX copiada!");
      });
    }
  </script>

</body>
</html>
