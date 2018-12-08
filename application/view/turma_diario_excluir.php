<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (!empty($arr_dados)) {
    $turma = $arr_dados["arr_turmas"];
    $arr_turmas = $arr_dados["arr_turmas"];
    $data = $arr_dados["arr_data"];
    $date = $arr_dados["arr_date"];
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <?php
    require_once("turma_diario_nav.php");
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Excluir diário</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/turma_diario_excluir">
                        <input type="hidden" name="diario[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="diario[turma_id]"
                        value="<?=$turma["turma_id"];?>">
                        <input type="hidden" name="diario[date]"
                        value="<?=$date;?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                            <label>Turma: </label>
                            <label><?=$turma["descricao"];?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <label>Data: </label>
                            <label><?=$data;?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-data" 
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