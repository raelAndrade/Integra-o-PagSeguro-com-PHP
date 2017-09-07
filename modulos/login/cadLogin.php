<h1>Faça o Login</h1>
<div class="login">
    <form action="<?= URL ?>/modulos/login/funLogin.php?op=login" method="post">
    	<label for="email">E-mail</label>
    	<input type="email" name="email" id="email" required="required" />
    	<label for="senha">Senha</label>
	    <input type="password" name="senha" id="senha" required="required" />
	    <button type="submit"><i class="icon-signin"></i> Entrar</button>
    </form>
</div>