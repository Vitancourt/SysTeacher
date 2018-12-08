<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_turmas = $arr_dados["arr_turmas"]; 
    $arr_alunos = $arr_dados["arr_alunos"]; 
} else {
    header("Location: /turma");
    exit();
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
                    <h3 class="box-title">Cadastrar diário - <?=$arr_turmas["descricao"]." - ".$arr_turmas["ano"];?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/turma_diario_cadastrar">
                    <input type="hidden" name="form[token]" 
                    value="<?=$this->token->generateToken();?>">
                    <input type="hidden" name="form[turma_id]" 
                    value="<?=$arr_turmas["turma_id"];?>">
                    <div class="col-md-12">
                            <!--date-->
                            <div class="form-group col-md-4">
                            <label>Data:</label>
                            <div class="input-group date">
                                    <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" 
                                    id="datepicker" name="form[data]"
                                    autocomplete="off" data-format="dd/MM/yyyy"
                                    value="<?=date("d/m/Y");?>"
                                    required>
                            </div>                            
                            <!--date-->                              
                            <?php
                            if ($arr_alunos) {
                                $i = 0;
                                foreach ($arr_alunos as $alunos) {
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label><?=$alunos["nome"];?></label><br>
                                        <input type="hidden" name="diario[<?=$i;?>][aluno_id]" value="<?=$alunos["aluno_id"];?>">
                                        <input type="hidden" name="diario[<?=$i;?>][vinculo_id]" value="<?=$alunos["vinculo_id"];?>">
                                        <label><input type="radio" name="diario[<?=$i;?>][presente]" checked value="1">Presente</label>
                                        <label><input type="radio" name="diario[<?=$i;?>][presente]" value="0">Ausente</label>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-diario" 
                            class="btn btn-info" type="submit" value="Gravar">
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
<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      language: 'pt-BR'
    })

  })
</script>
</body>
</html>