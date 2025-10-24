<?php
session_start();
include 'conexao.php';
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}
echo "<h2>Bem-vindo, " . $_SESSION['usuario'] . "</h2>";
echo "<a href='sair.php'>Sair</a> | <a href='carrinho.php'>Ver Carrinho</a><br><br>";
$result = $conn->query("SELECT * FROM produtos");
while ($p = $result->fetch_assoc()) {
  echo "<div><strong>{$p['nome']}</strong> - R$ {$p['preco']} 
        <a href='carrinho.php?add={$p['id']}'>[Adicionar]</a>
        <a href='carrinho.php?remover={$p['id']}'>[Remover]</a>
        </div>";
}
?>