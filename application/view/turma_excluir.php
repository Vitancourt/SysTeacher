<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
$turma = $arr_dados["turmas"];
if (empty($turma)) {
    exit();
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <?php
    require_once("turma_nav.php");
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Excluir turma</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/turma_excluir">
                        <input type="hidden" name="turma[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="turma[turma_id]"
                        value="<?=$turma["turma_id"];?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                            <label>Turma: </label>
                            <label><?=$turma["descricao"];?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <label>Ano: </label>
                            <label><?=$turma["ano"];?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-turma" 
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