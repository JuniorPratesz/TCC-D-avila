<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
echo "<h2>Compra finalizada!</h2>";
echo "PIX: 55984272911<br>";
echo "<a href='index.php'>Voltar à Loja</a>";
unset($_SESSION['carrinho']);
?>