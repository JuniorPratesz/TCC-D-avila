<?php session_start(); ?>
<!DOCTYPE html><html><head><title>Login</title></head><body>
<h2>Login</h2>
<form method="post" action="login_validar.php">
Email: <input type="email" name="email"><br>
Senha: <input type="password" name="senha"><br>
<button type="submit">Entrar</button>
</form>
<a href="cadastro.php">Cadastrar</a>
</body></html>