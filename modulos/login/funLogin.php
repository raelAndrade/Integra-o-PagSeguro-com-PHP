<?

	ob_start();
	session_start();
	
	include "../../lib/config.class.php";

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	echo '<meta charset="UTF-8" />';

	if (isset($_GET['op']) and $_GET['op'] == 'login') {

		$sql = " SELECT * FROM usuarios WHERE email='".addslashes($_POST['email'])."' AND senha = '".addslashes(md5($_POST['senha']))."' ";

		if($resultado = mysqli_query($link, $sql)){

			while ($registro = mysqli_fetch_assoc($resultado)) { // a variavel $linha recebe os dados que vem do banco de dados com a função mysqli_fetch_assoc($sql).
				$_SESSION['usuario_id'] = $registro['usuario_id'];

				header('Location: ../../');
			}

		}else{
			echo "Usuário não existente!";
		}
	}

	if (isset($_GET['op']) and $_GET['op'] == 'sair') {
		unset($_SESSION['usuario_id']);
		header('Location: ../../');
	}

?>