<?php
session_start();
include 'conexao.php';
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}
if (isset($_GET['add'])) {
  $_SESSION['carrinho'][] = $_GET['add'];
}
if (isset($_GET['remover'])) {
  $key = array_search($_GET['remover'], $_SESSION['carrinho']);
  if ($key !== false) {
    unset($_SESSION['carrinho'][$key]);
  }
}
echo "<h2>Carrinho</h2>";
$total = 0;
foreach ($_SESSION['carrinho'] as $id) {
  $q = $conn->query("SELECT * FROM produtos WHERE id=$id");
  if ($row = $q->fetch_assoc()) {
    echo "{$row['nome']} - R$ {$row['preco']}<br>";
    $total += $row['preco'];
  }
}
echo "<p><strong>Total: R$ $total</strong></p>";
echo "<a href='index.php'>Voltar</a> | <a href='finalizar.php'>Finalizar Compra</a>";
?>