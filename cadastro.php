<?php session_start(); ?>
<!DOCTYPE html><html><head><title>Cadastro</title></head><body>
<h2>Cadastro</h2>
<form method="post" action="cadastro_salvar.php">
Nome: <input type="text" name="nome"><br>
Email: <input type="email" name="email"><br>
Senha: <input type="password" name="senha"><br>
Confirmar: <input type="password" name="confirmar"><br>
<button type="submit">Cadastrar</button>
</form>
</body></html>