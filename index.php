<?
	ob_start();
	session_start();

	include "lib/config.class.php";
	include "lib/funReal.php";

	define("URL", "http://".$_SERVER['HTTP_HOST']."/integracao");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Curso de Integração com Sistemas de Pagamentos Online</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<header class="topo">
    	<div class="container">
        	<div class="row">
            	<div class="span3">
                	<a href="index.php" class="logo">Loja Virtual</a>
                </div>
                <div class="span9">
                	<ul class="unstyled pull-right">
                      	<li class="menu">
                        	<a href="index.php">
                            	<i class="icon-home"></i>
                                <br>
	                    		<span class="tit_menu">Home</span>
                            </a>
                        </li>
                        <li class="menu">
                        	<? if(!isset($_SESSION['usuario_id'])){ ?>
                        	<a href="index.php?mod=login">
                            	<i class="icon-signin"></i>
                                <br>
	                    		<span class="tit_menu">Login</span>
                            </a>
                            <? }else{ ?>
                            <a href="modulos/login/funLogin.php?op=sair">
                            	<i class="icon-signout"></i>
                                <br>
	                    		<span class="tit_menu">Sair</span>
                            </a>
                            <? } ?>
                        </li>
                        <? if(isset($_SESSION['usuario_id'])){?>
                    	<li class="menu">
                        	<a href="index.php?mod=vendas">
                            	<i class="icon-ok-sign"></i>
                                <br>
	                    		<span class="tit_menu">Pedidos</span>
                            </a>
                        </li>
                        <li class="carrinho">
                        	<i class="icon-shopping-cart"></i> 
                        	<span class="badge badge-success val_top">
                        		<?
                        			$objDb = new db();
									$link = $objDb->conecta_mysql();

									echo '<meta charset="UTF-8" />';

									$sql = "SELECT COUNT(carrinho_id) as total_produtos 
												FROM carrinho
												WHERE usuario_id = '".$_SESSION['usuario_id']."' 
						   					";
									if($resultado = mysqli_query($link, $sql)){
										while ($ln = mysqli_fetch_assoc($resultado)) {
											echo $ln['total_produtos'];
										}
									}
                        		?>
                        	</span>
	                    	<br>
	                    	<span class="tit_menu">Carrinho</span>
                            <div class="itens_carrinho">
	                            <?
	                            	$objDb = new db();
									$link = $objDb->conecta_mysql();

									echo '<meta charset="UTF-8" />';

									$sql = "SELECT * 
									 			FROM carrinho 
									   			INNER JOIN produto
									   			ON carrinho.produto_id = produto.produto_id
									   			WHERE carrinho.usuario_id = '".$_SESSION['usuario_id']."' 
									   		";
							        if($resultado = mysqli_query($link, $sql)){
	                            ?>
	                        	<table width="100%">
	                            	<thead>
	                                	<tr>
		                                	<th colspan="2" align="left">
		                                    	Produto
		                                    </th>
		                                    <th>
		                                    	Quant.
		                                    </th>
		                                    <th>
		                                    	Valor
		                                    </th>
		                                    <th>
		                                    	Total
		                                    </th>
		                                </tr>
	                                </thead>
	                                <tbody>
				                        <?
				                        	while ($registro = mysqli_fetch_assoc($resultado)) {
				                        ?>
	                                    <tr>
		                                	<td width="90" align="center">
		                                    	<a href="index.php?mod=carrinho">
	                                            	<img src="<?=URL?>/lib/rdmc.php?src=<?=URL?>/img/loja/<?=$registro['foto']?>&q=100&h=60&w=60" alt="<?=$registro['titulo']?>">
	                                            </a>
		                                    </td>
		                                    <td width="200" align="left">
		                                    	<?=$registro['titulo']?>
		                                    </td>
		                                	<td width="30">
		                                    	<?=$registro['quantidade']?>
		                                    </td>
		                                	<td width="85">
		                                    	R$ <?=Real($registro['preco'])?>
		                                    </td>
		                                    <td width="85">
		                                    	R$ <?=Real($registro['total'])?>
		                                    </td>
		                                </tr>		                                
		                                <?
		                                	}
		                                ?>
	                                </tbody>
	                                <tfoot>
	                                	<tr>
	                                        <td colspan="5" align="right">
	                                        SUBTOTAL: R$ 
	                                        <?
	                                        	$objDb = new db();
												$link = $objDb->conecta_mysql();

												echo '<meta charset="UTF-8" />';

												$st = "SELECT SUM(total) as total_compra 
															FROM carrinho
															WHERE usuario_id = '".$_SESSION['usuario_id']."' 
									   					";
									   			if($resultado = mysqli_query($link, $st)){
									   				while ($linha = mysqli_fetch_assoc($resultado)) {
									   					echo $total_compra = Real($linha['total_compra']);
									   				}
									   			}
	                                        ?>
	                                        </td>
	                                    </tr>
	                                    <tr>
	                                    	<td colspan="5" align="center">
	                                        	<a href="index.php?mod=carrinho" class="finalizar"><i class="icon-share-alt"></i> Finalizar <span>(Ir para o Carrinho)</span></a>
	                                        </td>
	                                    </tr>
	                                </tfoot>
	                            </table>
	                            <?
		                            }else{
		                        ?>
		                        	<tr>
			                           	<td colspan="5">
			                           		<div class="alert">Não há produtos adicionado ao carrinho!</div>
			                           	</td>
			                        </tr>
		                        <?
		                        	}
		                        ?>
	                        </div>
                        </li>
                        <? 
                        	} 
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    <main class="conteudo">
    	<div class="container">
        	<div class="row">
            	<div class="span12">
                	<?
                    	include "lisPaginas.php";
					?>

					<div class="modal hide fade" id="login">
					  <div class="modal-header">
					    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					    <h3>Faça o Login</h3>
					  </div>
					  <form method="post" action="<?=URL?>/modulos/login/funLogin.php?op=login" style="margin:0;">
					  	<div class="modal-body">
					  		<div class="alert">
					  			Para adicionar produtos ao carrinho é necessário efetuar o login.
					  		</div>
					    	<label for="email">Email</label>
					    	<input type="email" name="email" value="fabiogoodoy@gmail.com">
					    	<label for="senha">Senha</label>
					    	<input type="password" name="senha" value="123456">
					  	</div>
					  	<div class="modal-footer">
					    	<button type="submit" class="btn btn-primary">Logar</button>
					  	</div>
					  </form>
					</div>

                </div>
            </div>
        </div>
    </main>
    
    <footer class="rodape">
    	<div class="container">
        	<div class="row">
            	<div class="span4"></div>
            	<div class="span4"></div>
	         	<div class="span4 siga">
                	<h1>Siga Nos</h1>
                	<a href=""><i class="icon-facebook-sign"></i></a>
                    <a href=""><i class="icon-twitter-sign"></i></a>
                    <a href=""><i class="icon-google-plus-sign"></i></a>
                    <br>
                    <br>
                    <div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) {return;}
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					
					<div class="fb-wrap">
						<div class="fb-like-box" data-href="http://www.facebook.com/fabiogoodoy" data-width="292" data-show-faces="true" data-colorscheme="light" data-stream="false" data-header="false"></div>
                	</div>
            	</div>
            </div>
        </div>
    </footer>
    <script src="http://code.jquery.com/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
	<script src="js/gmaps.js" type="text/javascript"></script>
    <script src="js/cep.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/site.js"></script>
    <script>
		$(function(){
			wscep({map: 'map1',auto:true});
		})
	</script>
</body>
</html>