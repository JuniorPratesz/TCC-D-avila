<?php
session_start();
include 'conexao.php';
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar'];
if ($senha !== $confirmar) {
  echo "<script>alert('Senhas não conferem');window.location='cadastro.php';</script>";
  exit;
}
$hash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $hash);
if ($stmt->execute()) {
  $_SESSION['usuario'] = $nome;
  $_SESSION['id_usuario'] = $conn->insert_id;
  header("Location: index.php");
} else {
  echo "<script>alert('Erro no cadastro');window.location='cadastro.php';</script>";
}
?>