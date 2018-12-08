<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "aluno";
require_once("menu_esquerdo.php");
$aluno = $arr_dados["aluno"];
if (empty($aluno)) {
    exit();
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <?php
    require_once("aluno_nav.php");
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Excluir aluno</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/aluno_excluir">
                        <input type="hidden" name="aluno[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="aluno[aluno_id]"
                        value="<?=$aluno["aluno_id"];?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                            <label>Aluno: </label>
                            <label><?=$aluno["nome_completo"];?></label>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-aluno" 
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