<h1>Nossos Produtos</h1>
<ul class="unstyled lis_produtos">
    <?

        $objDb = new db();
        $link = $objDb->conecta_mysql();

        echo '<meta charset="UTF-8" />';

        $sql = " SELECT * FROM produto ORDER BY produto_id DESC ";

        if($resultado = mysqli_query($link, $sql)){

            while ($registro = mysqli_fetch_assoc($resultado)) {

    ?>
    <li>
        <a <? if(isset($_SESSION['usuario_id'])){?> href="modulos/loja/funLoja.php?op=add&produto_id=<?= $registro['produto_id'] ?>" <? }else{ ?> href="#login" data-toggle="modal" <? } ?> title="<?=$registro['titulo']?>">
            <span class="img">
                <img src="<?=URL?>/lib/rdmc.php?src=<?=URL?>/img/loja/<?=$registro['foto']?>&q=100&h=100&w=160" alt="<?=$registro['titulo']?>">
            </span>
            <span class="titulo">
                <!-- Titulo do meu produto -->
                <?=$registro['titulo']?>
                <span class="paragraph-end"></span>
            </span>
            <span class="subtitulo">
                <!-- Subtitulo longo para est produto -->
                <?=$registro['subtitulo']?>
                <span class="paragraph-end"></span>
            </span>
            <span class="preco">
                <!-- R$ 59,90 -->
                R$ <?=Real($registro['preco'])?>
            </span>
            <span class="comprar">
                <i class="icon-shopping-cart"></i> Comprar
            </span>
        </a>
    </li>
    <?
            }
        }
    ?>
</ul>