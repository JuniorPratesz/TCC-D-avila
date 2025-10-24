<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

// Inicializa o carrinho se não existir
if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

// Adicionar produto
if (isset($_GET['add'])) {
  $_SESSION['carrinho'][] = $_GET['add'];
}

// Remover produto
if (isset($_GET['remover'])) {
  $key = array_search($_GET['remover'], $_SESSION['carrinho']);
  if ($key !== false) {
    unset($_SESSION['carrinho'][$key]);
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meu Carrinho - Mercado D'avila</title>
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

    .carrinho-card {
      background-color: white;
      border: 1px solid #ffdbb3;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      padding: 20px;
      transition: 0.3s;
    }

    .carrinho-card:hover {
      transform: translateY(-3px);
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
      <h2 class="m-0"><i class="bi bi-cart4"></i> Meu Carrinho</h2>
        <img src="logo.png" alt="Logo" style="width:240px;height:100px;">
      <div>
        <span>Bem-vindo, <strong><?php echo $_SESSION['usuario']; ?></strong></span>
        <a href="index.php" class="btn btn-light btn-sm"><i class="bi bi-shop"></i> Voltar à Loja</a>
        <a href="sair.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</a>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="carrinho-card mt-4">
          <h4 class="mb-3 text-center"><i class="bi bi-basket"></i> Itens no seu carrinho</h4>

          <?php
          $total = 0;

          if (!empty($_SESSION['carrinho'])) {
            echo '<ul class="list-group mb-3">';
            foreach ($_SESSION['carrinho'] as $id) {
              $id = intval($id);
              $sql = "SELECT * FROM produtos WHERE id = $id";
              $q = mysqli_query($conn, $sql);
              if ($row = mysqli_fetch_assoc($q)) {
                echo "
                  <li class='list-group-item d-flex justify-content-between align-items-center'>
                    <div>
                      <strong>{$row['nome']}</strong><br>
                      <small class='text-muted'>R$ " . number_format($row['preco'], 2, ',', '.') . "</small>
                    </div>
                    <a href='carrinho.php?remover={$row['id']}' class='btn btn-outline-danger btn-sm'>
                      <i class='bi bi-trash'></i> Remover
                    </a>
                  </li>
                ";
                $total += $row['preco'];
              }
            }
            echo '</ul>';
            echo "<p class='text-end fs-5'><strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong></p>";
          } else {
            echo "<p class='text-center text-muted'>Seu carrinho está vazio.</p>";
          }
          ?>

          <div class="d-flex justify-content-between mt-4">
            <a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Continuar Comprando</a>
            <?php if (!empty($_SESSION['carrinho'])): ?>
              <a href="finalizar.php" class="btn btn-laranja"><i class="bi bi-credit-card"></i> Finalizar Compra</a>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Mercado D'avila - Adicione seus produtos e aproveite 😋.</p>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
