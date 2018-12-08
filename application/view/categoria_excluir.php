<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "categoria";
require_once("menu_esquerdo.php");
$categoria = $arr_dados["categoria"];
if (empty($categoria)) {
    exit();
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <?php
    require_once("categoria_nav.php");
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Excluir categoria</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/categoria_excluir">
                        <input type="hidden" name="categoria[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="categoria[categoria_id]"
                        value="<?=$categoria["categoria_id"];?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                            <label>Categoria: </label>
                            <label><?=$categoria["descricao"];?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-categoria" 
                            class="btn btn-danger" type="submit" value="Excluir">
                            </div>
                        </div>
                    </form>
                </div>          
            </div>
            <!-- /.box -->
            </div>
        </div>
    </section>
</div>
<?php
require_once ("footer.php");
?>
</body>
</html>