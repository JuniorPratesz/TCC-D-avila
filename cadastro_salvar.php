<?php
session_start();
include 'conexao.php'; // conexão: $conn = mysqli_connect(...);

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$confirmar = $_POST['confirmar'];

// Verifica se as senhas são iguais
if ($senha !== $confirmar) {
    echo "<script>alert('Senhas não conferem');window.location='cadastro.php';</script>";
    exit;
}

// Escapa os dados para evitar SQL injection
$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);

// Criptografa a senha
$hash = password_hash($senha, PASSWORD_DEFAULT);

// Monta a query
$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$hash')";

// Executa a query
if (mysqli_query($conn, $sql)) {
    $_SESSION['usuario'] = $nome;
    $_SESSION['id_usuario'] = mysqli_insert_id($conn);
    header("Location: index.php");
    exit;
} else {
    echo "<script>alert('Erro no cadastro');window.location='cadastro.php';</script>";
}

// Fecha a conexão (opcional)
mysqli_close($conn);
?>
