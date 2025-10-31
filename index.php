<?php
session_start();
include 'conexao.php'; // deve conter a variável $conn = mysqli_connect(...)

if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>MERCADO D'AVILA</title>
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

    header {
      background-color: #ff7b00;
      color: white;
      padding: 15px 0;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    header a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: 500;
      transition: 0.3s;
    }

    header a:hover {
      text-decoration: underline;
    }

    .container {
      margin-top: 40px;
    }

    .produto-card {
      background-color: white;
      border: 1px solid #ffdbb3;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 20px;
      transition: 0.3s;
    }

    .produto-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
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
      margin-top: 50px;
    }
  </style>
</head>
<body>

  <header class="text-center">
    <div class="container d-flex justify-content-between align-items-center">
      <h2 class="m-0"><i class="bi bi-shop"></i> fone:(55)984272911</h2>
        <img src="imagens/logo.png" alt="Logo" style="width:240px;height:100px;">
      <div>
        <span>Bem-vindo, <strong><?php echo $_SESSION['usuario']; ?></strong></span>
        <a href="carrinho.php" class="btn btn-light btn-sm"><i class="bi bi-cart3"></i> Ver Carrinho</a>
        <a href="sair.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row g-4">
      <?php
      // Consulta usando estilo procedural
      $sql = "SELECT * FROM produtos";
      $result = mysqli_query($conn, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($p = mysqli_fetch_assoc($result)) {
      ?>
          <div class="col-md-4 col-lg-3">
            <div class="produto-card text-center">
              <img src="<?php echo !empty($p['imagem']) ? $p['imagem'] : 'https://via.placeholder.com/200x200?text=Produto'; ?>" 
                   alt="<?php echo htmlspecialchars($p['nome']); ?>" 
                   class="img-fluid rounded mb-3">
              <h5 class="fw-bold"><?php echo htmlspecialchars($p['nome']); ?></h5>
              <p class="text-muted mb-2">R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
              <div class="d-flex justify-content-center gap-2">
                <a href="carrinho.php?add=<?php echo $p['id']; ?>" class="btn btn-laranja btn-sm">
                  <i class="bi bi-plus-circle"></i> Adicionar
                </a>
                <a href="carrinho.php?remover=<?php echo $p['id']; ?>" class="btn btn-outline-secondary btn-sm">
                  <i class="bi bi-dash-circle"></i> Remover
                </a>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p class='text-center text-muted'>Nenhum produto encontrado.</p>";
      }

      mysqli_free_result($result);
      ?>
    </div>
  </div>

  <div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Mercado D'avila - Melhores Preços 💲.</p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script JS -->
  <script>
    // Animação ao clicar em "Adicionar"  
    document.querySelectorAll('.btn-laranja').foreach(btn => {
      btn.addEventListener('click', () => {
        btn.innerHTML = '<i class="bi bi-check-circle"></i> Adicionado!';
        btn.classList.add('disabled');
        setTimeout(() => {
          btn.innerHTML = '<i class="bi bi-plus-circle"></i> Adicionar';
          btn.classList.remove('disabled');
        }, 1500);
      });
    });
  </script>

</body>
</html>

