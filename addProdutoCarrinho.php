<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_produto = intval($_POST['id_produto']);
$quantidade = intval($_POST['quantidade']);

if ($quantidade < 1) { $quantidade = 1; }

// 1. Verifica se o produto existe
$sql = "SELECT estoque FROM produtos WHERE id = $id_produto";
$q = mysqli_query($conn, $sql);
$p = mysqli_fetch_assoc($q);

if (!$p) { header("Location: index.php?erro=produto_inexistente"); exit; }

$estoque = $p['estoque'];
if ($estoque <= 0) {
    header("Location: index.php?erro=sem_estoque");
    exit;
}

// 2. Cria carrinho se não existir
$sql = "SELECT id FROM carrinho WHERE id_usuario = $id_usuario";
$q = mysqli_query($conn, $sql);

if (mysqli_num_rows($q) > 0) {
    $carrinho = mysqli_fetch_assoc($q)['id'];
} else {
    mysqli_query($conn, "INSERT INTO carrinho (id_usuario) VALUES ($id_usuario)");
    $carrinho = mysqli_insert_id($conn);
}

// 3. Vê se item já existe no carrinho
$sql = "SELECT quantidade FROM itens_carrinho WHERE id_produto = $id_produto AND id_carrinho = $carrinho";
$q = mysqli_query($conn, $sql);

if (mysqli_num_rows($q) > 0) {
    $atual = mysqli_fetch_assoc($q)['quantidade'];
    $nova = min($estoque, $atual + $quantidade);
    mysqli_query($conn, "UPDATE itens_carrinho SET quantidade = $nova WHERE id_produto = $id_produto AND id_carrinho = $carrinho");
} else {
    $nova = min($estoque, $quantidade);
    mysqli_query($conn, "INSERT INTO itens_carrinho (id_produto, id_carrinho, quantidade)
                         VALUES ($id_produto, $carrinho, $nova)");
}

header("Location: carrinho.php?ok=1");
exit;
