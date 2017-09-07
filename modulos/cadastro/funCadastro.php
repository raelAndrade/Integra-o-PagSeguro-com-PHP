<?php

	include "../../lib/config.class.php";

	$objDb = new db();
	$link = $objDb->conecta_mysql();



	$sql = " INSERT INTO usuarios (nome, email, senha, permissao) values('".$_POST['nome']."', '".$_POST['email']."', '".md5($_POST['senha'])."', '".$_POST['permissao']."')";

	mysqli_query($link, $sql);

	echo "Usuário cadastrado com sucesso!!!";
	// echo $sql;

	
?>