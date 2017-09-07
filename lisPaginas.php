<?
	if(!isset($_GET['mod'])){		
		include "detHome.php";
	}else{
		switch($_GET['mod']){
			default:
			include "detHome.php";
			break;

			case 'home':
			include "detHome.php";
			break;
			
			case 'carrinho':
			include "modulos/loja/detCarrinho.php";
			break;
			
			case 'login':
			include "modulos/login/cadLogin.php";
			break;
			
			case 'vendas':
			include "modulos/vendas/lisVendas.php";
			break;
			
			case 'pedido':
			include "modulos/vendas/detPedido.php";
			break;

			case 'pedido-concluido':
			include "modulos/loja/detPedidoConcluido.php";
			break;


		}	
	}
?>