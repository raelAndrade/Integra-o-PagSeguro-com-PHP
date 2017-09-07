<h1>Carrinho de Compras</h1>
<table width="100%" class="table lis_carrinho">
	<thead>
    	<tr>
        	<th colspan="2">
	        <div class="text-left">
            	Produto
	        </div>
            </th>
	    	<th width="100">
		        <div class="text-center">
	            	Quantidade
		        </div>
            </th>
	    	<th width="100">
		        <div class="text-center">
	            	Valor
	            </div>
	        </th>
            <th width="100">
                <div class="text-center">
                    Total
                </div>
            </th>
            <th width="80">
		        <div class="text-center">
	            	Remover
	            </div>
	        </th>
        </tr>
    </thead>
    <tbody>
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
                while ($registro = mysqli_fetch_assoc($resultado)) {
        ?>
    	<tr>
        	<td width="160">
            	<div class="text-center">
                	<a href="index.php" title="<?=$registro['titulo']?>">
	                    <img src="<?=URL?>/lib/rdmc.php?src=<?=URL?>/img/loja/tenis1.jpg&q=100&h=120&w=120" alt="<?=$registro['titulo']?>">
	                </a>
                </div>
            </td>
        	<td>
            	<div class="text-left">
                	<!-- Titulo do meu Produto -->
                    <?=$registro['titulo']?>
                </div>
            </td>
        	<td align="center" class="amount">
                <div class="text-center">
                    <form action="modulos/loja/funLoja.php?op=quantidade" method="post">
                        <input type="hidden" name="preco" value="">
                        <div class="input-append">
                          <input type="number" name="quantidade" min="1" max="10" value="<?=$registro['quantidade']?>">
                          <button type="submit" class="btn"><i class="icon-refresh"></i></button>
                        </div>
                    </form>
                </div>
            </td>
        	<td align="center">
            	<div class="text-center">
            		<!-- R$ 59,90 -->
                    <?=Real($registro['preco'])?>
            </td>
            <td align="center">
                <div class="text-center">
                    <!-- R$ 59,90 -->
                    <?=Real($registro['total'])?>
                </div>
            </td>
            <td align="center">
            	<div class="text-center">
                	<a href="modulos/loja/funLoja.php?op=remover&carrinho_id=<?=$registro['carrinho_id']?>">
                        <i class="icon-remove"></i>
                    </a>
                </div>
            </td>
        </tr>
        <?
                }
            }else{
        ?>
        <tr>
            <td colspan="6">
                <div class="alert">Não há produtos adicionado ao carrinho!</div>
            </td>
        </tr>
        <? } ?>
    </tbody>
    <tfoot>
    	<tr>
        	<td colspan="6" class="total">
            	<div class="text-right total">
                	<!-- SUBTOTAL: R$ 59,90 -->
                    SUBTOTAL: R$ <? if (!empty($total_compra)){echo $total_compra;} else{echo "0,00";} ?>
                </div>
            </td>
        </tr>
        <tr>
        	<td colspan="3">
            	<a href="index.php" class="finalizar"><i class="icon-chevron-left"></i> Continuar Comprando</a>
            </td>
            <td colspan="3">
                <a href="#carrinho" class="concluir pull-right accordion-toggle" data-toggle="collapse" data-parent="#accordion"><i class="icon-ok"></i> Concluir Pedido</a>
            </td>
        </tr>
    </tfoot>
</table>

<div class="accordion dados" id="accordion">
    <div id="carrinho" class="accordion-body collapse <? if(isset($_GET['metodo'])){?>in<? }?>">
      <div class="accordion-inner">
        <h1><span class="badge badge-success val_top">1</span> Primeiro passo</h1>
        <h2>Escolha abaixo a forma de Pagamento!</h2>
        <br />
        <div class="row">
            <div class="span4">
                <a href="index.php?mod=carrinho&metodo=paypal#finalizar" class="pague">Pague com <br /> <span class="paypal"></span></a>
            </div>
            <div class="span4">
                <a href="index.php?mod=carrinho&metodo=pagseguro#finalizar" class="pague">Pague com <br /> <span class="pagseguro"></span></a>
            </div>
        </div>
        <? if(isset($_GET['metodo'])){ ?>
        <div class="row" id="finalizar">
            <div class="span5 form">
                <h1><span class="badge badge-success val_top">2</span> Segundo passo</h1>
                <h2>Preencha seus dados para entrega!</h2>
                <?
                	if($_GET['metodo']=='paypal'){
				?>
	                <form method="post" action="https://www.paypal.com/cgi-bin/webscr">
                        <!-- Carrinho -->
                        <input type="hidden" name="cmd" value="_cart" readonly="readonly" />
                        <input type="hidden" name="upload" value="1" readonly="readonly" />

                        <!-- Codificação -->
                        <input type="hidden" name="charset" value="utf-8" readonly="readonly" />

                        <!-- Moeda -->
                        <input type="hidden" name="currency_code" value="BRL" readonly="readonly" />

                        <!-- Seu ID ou E-mail de Vendedor -->
                        <input type="hidden" name="business" value="" readonly="readonly" />

                        <!-- Identificação Customizada -->
                        <input type="hidden" name="custom" value="" readonly="readonly" />

                        <!-- Sua logo -->
                        <input type="hidden" name="cpp_logo_image" value="" readonly="readonly" />

                        <!-- URL do Carrinho -->
                        <input type="hidden" name="shopping_url" value="<?=URL?>/index.php?mod=carrinho" />

                        <!-- URL Conclusão do Pedido -->
                        <input type="hidden" name="return" value="<?=URL?>/index.php?mod=pedido-concluido" readonly="readonly" />

                        <!-- URL de Notificação -->
                        <input type="hidden" name="notify_url" value="<?=URL?>/modulos/loja/funPaypal.php" readonly="readonly" />

                        <!-- Habilitando dados preenchido -->
                        <input type="hidden" name="address_override" class="input-xlarge" value="1" readonly="readonly" />
                        
                        <!-- Dados do Cliente -->
                        
                        <!-- E-mail -->
		                <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" value="" required />

                        <!-- Primeiro Nome -->
		                <label for="nome">Nome</label>
                        <input type="text" name="first_name" id="nome" class="input-xlarge" value="" required/>
		                
                        <!-- Sobrenome -->
                        <label for="sobrenome">Sobrenome</label>
                        <input type="text" name="last_name" id="sobrenome" class="input-xlarge" required />
                        
                        <!-- CEP -->
		                <label for="cep">CEP:</label>
		                <input type="text" name="zip" id="cep" pattern="[0-9]{5}[\-]?[0-9]{3}" class="input-small" required />
                        
                        <!-- Endereço, Número e Complemento -->
		                <label for="endereco">Endereço:</label>
		                <input type="text" name="address1" id="endereco" class="input-xlarge" required />

                        <!-- Bairro -->
		                <label for="bairro">Bairro:</label>
		                <input type="text" name="address2" id="bairro" class="input-xlarge" />
                        
                        <!-- Cidade -->
		                <label for="cidade">Cidade:</label>
		                <input type="text" name="city" id="cidade" class="input-xlarge" required />
                        
                        <!-- Estado -->
		                <label for="uf">Estado:</label>
		                <input type="text" name="state" id="uf" class="input-mini" maxlength="2" required />

                        <!-- Dados dos Produtos -->
                        <!-- Cod do Produto -->
                        <input type="hidden" name="item_number_x" value="" readonly="readonly" />

                        <!-- Titulo do Produto -->
                        <input type="hidden" name="item_name_x" value="" readonly="readonly" />
                        
                        <!-- Quantidade de Itens -->
                        <input type="hidden" name="quantity_x" value="" readonly="readonly" />
                        
                        <!-- Preço total do Produto -->
                        <input type="hidden" name="amount_x" value="" readonly="readonly" />

                        <button type="submit" class="pague"><i class="icon-ok"></i> Finalizar Compra</button>
	                </form>
                <? }elseif($_GET['metodo']=='pagseguro'){ ?>
                	<form method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html">

                        <!-- Codificação -->
                        <input type="hidden" name="encoding" value="UTF-8" readonly="readonly" />

                        <!-- Email vendedor -->
                        <input type="hidden" name="receiverEmail" value="" readonly="readonly" />

                        <!-- Moeda -->
                        <input type="hidden" name="currency" value="BRL" readonly="readonly" />

                        <!-- Identificação Customizada -->
                        <input type="hidden" name="reference" value="" readonly="readonly" />

                        <!-- Dados do Cliente -->

                        <!-- E-mail -->
		                <label for="email">E-mail</label>
		                <input type="email" name="senderEmail" id="email" class="input-xlarge" required />

                        <!-- Nome Completo -->
		                <label for="nome">Nome</label>
		                <input type="text" name="senderName" id="nome" class="input-xlarge" required />

                        <!-- CEP -->
		                <label for="cep">CEP:</label>
		                <input type="text" name="shippingAddressPostalCode" id="cep" pattern="[0-9]{5}[\-]?[0-9]{3}" class="input-small" required />

                        <!-- Endereço -->
		                <label for="endereco">Endereço:</label>
		                <input type="text" name="shippingAddressStreet" id="endereco" class="input-xlarge" required />
    
                        <!-- Número da Residência -->
		                <label for="num">Número:</label>
		                <input type="text" name="shippingAddressNumber" id="num" class="input-small" />
                        
                        <!-- Complemento -->
		                <label for="comp">Complemento:</label>
		                <input type="text" name="shippingAddressComplement" id="comp" class="input-xlarge" />

                        <!-- Bairro -->
		                <label for="bairro">Bairro:</label>
		                <input type="text" name="shippingAddressDistrict" id="bairro" class="input-xlarge" required />

                        <!-- Cidade -->
		                <label for="cidade">Cidade:</label>
		                <input type="text" name="shippingAddressCity" id="cidade" class="input-xlarge" required />


		                <label for="uf">Estado:</label>
		                <input type="text" name="shippingAddressState" id="uf" class="input-mini" maxlength="2" required />

                        <!-- País -->
                        <input type="hidden" name="shippingAddressCountry" value="BRA" readonly="readonly" />

                        
                        <!-- Dados do Carrinho -->


                        <!-- Formato do Frete 
                        1 - PAC
                        2 - Sedex
                        3 - O Cliente escolhe Pac ou Sedex
                        -->
                        <input type="hidden" name="shippingType" value="3" />

                        <!-- Dados dos Produtos -->

                        <!-- ID do Produto -->
                        <input type="hidden" name="itemIdx" value="" readonly="readonly" />

                        <!-- Nome do Produto -->
                        <input type="hidden" name="itemDescriptionx" value="" readonly="readonly" />

                        <!-- Quantidade de Itens -->
                        <input type="hidden" name="itemQuantityx" value="" readonly="readonly" />

                        <!-- Preço do Produto -->
                        <input type="hidden" name="itemAmountx" value="" readonly="readonly" />
                        
                        <!-- Preço do Frete 
                        <input type="hidden" name="itemShippingCost<?=$i?>" value="9.90" readonly="readonly" /> -->

                        <!-- Peso -->
                        <input type="hidden" name="itemWeightx" value=""> 

                        <button type="submit" class="pague"><i class="icon-ok"></i> Finalizar Compra</button>
	                </form>
                <? } ?>
            </div>
            <div class="span6">
	            <br />
	            <br />
	            <br />
            	<h1><i class="icon-usd"></i> Formas de Pagamento</h1>
                <img src="img/outras/formas.png" alt="Formas de pagamento Paypal e Pagseguro" />
                <br />
                <br />
                <h1><i class="icon-map-marker"></i> Sua localização</h1>
                <div class="map" id="map1"></div>
            </div>
        </div>
        <? } ?>
      </div>
    </div>
</div>