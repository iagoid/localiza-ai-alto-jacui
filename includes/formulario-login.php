<?php

	$alertaLogin = strlen($alertaLogin) ? '<div class=" alert alert-danger">' . $alertaLogin . '</div>' : '';

?>
<div class="jumbotron text-dark">


<form method="POST">
	
	<h2 class="mb-3 ml-5">Login</h2>

<div class="ml-5 row">
<div class="col">
	<?=$alertaLogin?>
	<div class="form-group mt-3">
		<input type="text" name="login" class="form-control" placeholder="Login" required>
	</div>
	<div class="form-group mt-3">
		<input type="password" name="senha" class="form-control" placeholder="Senha" required>
	</div>

	<div class="form-group mt-3">
		<button type="submit" name="acao" class="btn btn-primary">Logar</button>
	</div>
</div>
<div class="col">
	
</div>

</div>
</div>
</form>