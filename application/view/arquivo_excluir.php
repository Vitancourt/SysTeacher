<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "bancodearquivo";
require_once("menu_esquerdo.php");
$arquivo = $arr_dados["arr_arquivo"];
if (empty($arquivo)) {
    exit();
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <?php
    require_once("arquivo_nav.php");
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Excluir arquivo</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/arquivo_excluir">
                        <input type="hidden" name="arquivo[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="arquivo[arquivo_id]"
                        value="<?=$arquivo["arquivo_id"];?>">
                        <input type="hidden" name="arquivo[caminho]"
                        value="<?=$arquivo["caminho"];?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                            <label>Arquivo: </label>
                            <label><?=$arquivo["descricao"];?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-arquivo" 
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