<?php
session_start();
require 'conexao.php';
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

    .qty-box {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .qty-box button {
      width: 32px;
      height: 32px;
      border: none;
      background-color: #ff7b00;
      color: white;
      font-size: 18px;
      border-radius: 6px;
    }

    .qty-box input {
      width: 50px;
      text-align: center;
      border-radius: 6px;
      border: 1px solid #ccc;
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
    <h2 class="m-0"><i class="bi bi-shop"></i> Itajaí/SC</h2>

    <img src="imagens/logo.png" alt="Logo" style="width:240px;height:100px;">

    <?php if (!isset($_SESSION['usuario'])) { ?>
      <a href="login.php" class="btn btn-outline-light btn-sm">
        <i class="bi bi-box-arrow-right"></i> Entrar
      </a>
    <?php } else { ?>
      <div>
        <span>Bem-vindo, <strong><?= $_SESSION['usuario'] ?></strong></span>
        <a href="carrinho.php" class="btn btn-light btn-sm"><i class="bi bi-cart3"></i> Carrinho</a>
        <a href="sair.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</a>
      </div>
    <?php } ?>
  </div>
</header>

<div class="container mt-4">
  <div class="row g-4">

    <?php
    $sql = "SELECT * FROM produtos";
    $result = mysqli_query($conn, $sql);

    while ($p = mysqli_fetch_assoc($result)) {
        $estoque = isset($p['estoque']) ? intval($p['estoque']) : 0;
    ?>

      <div class="col-md-4 col-lg-3">
        <div class="produto-card text-center">

          <img src="<?= !empty($p['imagem']) ? $p['imagem'] : 'https://via.placeholder.com/200x200?text=Produto'; ?>"
               class="img-fluid rounded mb-3">

          <h5 class="fw-bold"><?= htmlspecialchars($p['nome']); ?></h5>
          <p class="text-muted">R$ <?= number_format($p['preco'], 2, ',', '.'); ?></p>

          <p class="text-secondary">
            Estoque: <strong><?= $estoque ?></strong>
          </p>

          <?php if ($estoque > 0) { ?>
          <form action="addProdutoCarrinho.php" method="POST">

            <div class="qty-box">
              <button type="button" class="btn-minus">-</button>
              <input type="number" name="quantidade" value="1" min="1" max="<?= $estoque ?>" class="qty-input">
              <button type="button" class="btn-plus">+</button>
            </div>

            <input type="hidden" name="id_produto" value="<?= $p['id'] ?>">

            <button type="submit" class="btn btn-laranja w-100 mt-2">
              <i class="bi bi-cart-plus"></i> Adicionar ao Carrinho
            </button>
          </form>
          <?php } else { ?>
            <p class="text-danger fw-bold">Produto Esgotado</p>
          <?php } ?>

        </div>
      </div>

    <?php } ?>
  </div>
</div>

<div class="footer">
  <p>&copy; <?= date("Y"); ?> Mercado D'avila - Melhores Preços 💲.</p>
</div>

<script>
// botões de quantidade
document.querySelectorAll('.produto-card').forEach(card => {
  const minus = card.querySelector('.btn-minus');
  const plus = card.querySelector('.btn-plus');
  const input = card.querySelector('.qty-input');
  const max = parseInt(input.max);

  minus.addEventListener('click', () => {
    let v = parseInt(input.value);
    if (v > 1) input.value = v - 1;
  });

  plus.addEventListener('click', () => {
    let v = parseInt(input.value);
    if (v < max) input.value = v + 1;
  });
});
</script>

</body>
</html>
