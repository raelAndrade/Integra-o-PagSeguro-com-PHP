<?
	ob_start();
	session_start();

	include "../../lib/config.class.php";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	echo '<meta charset="UTF-8" />';

	if (isset($_GET['op']) and $_GET['op'] == 'add' and isset($_GET['produto_id'])) {
		$cp = " SELECT * FROM carrinho WHERE usuario_id = '".$_SESSION['usuario_id']."' and produto_id = '".$_GET['produto_id']."' ";
		$sql_carrinho = mysqli_query($link, $cp);
		if (mysqli_num_rows($sql_carrinho) == false) {
			$sql = " SELECT preco FROM produto WHERE produto_id = '".$_GET['produto_id']."' ";
			$sql_produto = mysqli_query($link, $sql);
			if(mysqli_num_rows($sql_produto) == true ){
				while($registro = mysqli_fetch_assoc($sql_produto)){
					$preco = $registro['preco'];
				}
			}
			$inserir_carrinho = " INSERT INTO carrinho (usuario_id, produto_id, quantidade, total) values ('".$_SESSION['usuario_id']."','".$_GET['produto_id']."',1, '".$preco."') ";
			mysqli_query($link, $inserir_carrinho);
		}
		header('Location: ../../index.php?mod=carrinho');
	}

	if (isset($_GET['op']) and $_GET['op'] == 'remover' and isset($_GET['carrinho_id'])) {
		$resultado = "DELETE FROM carrinho WHERE carrinho_id = '".$_GET['carrinho_id']."' and usuario_id = '".$_SESSION['usuario_id']."'";
		mysqli_query($link, $resultado);
		header('Location: ../../index.php?mod=carrinho');
	}
?>