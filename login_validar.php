<?php
session_start();
include 'conexao.php';
$email = $_POST['email'];
$senha = $_POST['senha'];
$sql = "SELECT * FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
  $usuario = $result->fetch_assoc();
  if (password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario'] = $usuario['nome'];
    $_SESSION['id_usuario'] = $usuario['id'];
    header("Location: index.php");
    exit;
  }
}
echo "<script>alert('Login inválido');window.location='login.php';</script>";
?>