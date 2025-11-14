<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Busca carrinho do usuário
$sql = "SELECT id FROM carrinho WHERE id_usuario = $id_usuario";
$q = mysqli_query($conn, $sql);

if (mysqli_num_rows($q) == 0) {
    mysqli_query($conn, "INSERT INTO carrinho (id_usuario) VALUES ($id_usuario)");
    $id_carrinho = mysqli_insert_id($conn);
} else {
    $id_carrinho = mysqli_fetch_assoc($q)['id'];
}

// Atualizar quantidades
if (isset($_POST['atualizar']) && isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $id_produto => $qtd) {
        $id_produto = intval($id_produto);
        $qtd = intval($qtd);

        // Verifica estoque
        $estoque_res = mysqli_query($conn, "SELECT estoque FROM produtos WHERE id = $id_produto");
        $estoque = mysqli_fetch_assoc($estoque_res)['estoque'];

        if ($qtd > $estoque) $qtd = $estoque;

        if ($qtd > 0) {
            mysqli_query($conn, "UPDATE itens_carrinho SET quantidade = $qtd 
                                WHERE id_carrinho = $id_carrinho AND id_produto = $id_produto");
        } else {
            mysqli_query($conn, "DELETE FROM itens_carrinho 
                                 WHERE id_carrinho = $id_carrinho AND id_produto = $id_produto");
        }
    }

    header("Location: carrinho.php");
    exit;
}

// Remover item
if (isset($_GET['remover'])) {
    $id_remover = intval($_GET['remover']);
    mysqli_query($conn, "DELETE FROM itens_carrinho 
                         WHERE id_carrinho = $id_carrinho AND id_produto = $id_remover");
    header("Location: carrinho.php");
    exit;
}

// Buscar itens do carrinho
$sql = "
    SELECT i.id_produto, i.quantidade, p.nome, p.preco, p.imagem, p.estoque
    FROM itens_carrinho i
    INNER JOIN produtos p ON p.id = i.id_produto
    WHERE i.id_carrinho = $id_carrinho
";

$itens = mysqli_query($conn, $sql);
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho - Mercado D'avila</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #fffaf5; font-family: 'Poppins', sans-serif; }
        header { background-color: #ff7b00; color: white; padding: 15px 0; }
        .carrinho-card {
            background-color: white; border: 1px solid #ffdbb3;
            border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 20px;
        }
        .btn-laranja { background-color: #ff7b00; color: white; }
        .btn-laranja:hover { background-color: #e66a00; }
        .footer {
            background-color: #ff7b00; color: white;
            text-align: center; padding: 15px; margin-top: 50px;
        }
        .qty-box { width: 70px; }
    </style>
</head>

<body>

<header>
    <div class="container d-flex justify-content-between align-items-center">
        <h2><i class="bi bi-cart4"></i> Meu Carrinho</h2>

        <img src="imagens/logo.png" style="width:240px;height:100px;">

        <div>
            <span>Bem-vindo, <strong><?= $_SESSION['usuario'] ?></strong></span>
            <a href="index.php" class="btn btn-light btn-sm"><i class="bi bi-shop"></i> Comprar mais</a>
            <a href="sair.php" class="btn btn-outline-light btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</a>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="carrinho-card">

                <h4 class="text-center mb-4"><i class="bi bi-basket"></i> Itens do Carrinho</h4>

                <?php if (mysqli_num_rows($itens) == 0): ?>

                    <p class="text-center text-muted">Seu carrinho está vazio 😢</p>

                <?php else: ?>

                    <form method="POST">

                        <ul class="list-group mb-3">
                        <?php while ($item = mysqli_fetch_assoc($itens)): 
                            $subtotal = $item['preco'] * $item['quantidade'];
                            $total += $subtotal;
                        ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?= $item['imagem'] ?>" width="70" class="rounded">

                                    <div>
                                        <strong><?= $item['nome'] ?></strong><br>
                                        <small>R$ <?= number_format($item['preco'],2,',','.') ?></small><br>
                                        <small class="text-secondary">Estoque: <?= $item['estoque'] ?></small>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-3">

                                    <input class="form-control qty-box" type="number"
                                           name="qty[<?= $item['id_produto'] ?>]"
                                           value="<?= $item['quantidade'] ?>"
                                           min="1" max="<?= $item['estoque'] ?>">

                                    <a href="carrinho.php?remover=<?= $item['id_produto'] ?>"
                                       class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>

                            </li>
                        <?php endwhile; ?>
                        </ul>

                        <p class="text-end fs-5"><strong>Total: R$ <?= number_format($total,2,',','.') ?></strong></p>

                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Continuar Comprando
                            </a>

                            <button name="atualizar" class="btn btn-laranja">
                                <i class="bi bi-arrow-repeat"></i> Atualizar Carrinho
                            </button>

                            <a href="finalizar.php" class="btn btn-success">
                                <i class="bi bi-credit-card"></i> Finalizar Compra
                            </a>
                        </div>

                    </form>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>&copy; <?= date("Y") ?> Mercado D'avila - Obrigado pela preferência! ❤️</p>
</div>

</body>
</html>
