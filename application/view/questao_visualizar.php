<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "questao";
require_once("menu_esquerdo.php");
if (isset($arr_dados)) {
    $questao = $arr_dados["arr_questao"];
    $resposta = $arr_dados["arr_resposta"];
}
if (empty($questao)) {
    exit();
}
?>
<style>
    img{
        max-width:40%;
        max-height: 40%;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Visualizar questão</h3>
                    <br>
                    <a class="btn btn-warning no-print" 
                    onclick="window.print()"><i class="fa fa-print"></i>           
                    Imprimir
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group col-md-12">
                        <label>Descrição: </label><br>
                        <?=$questao["descricao"];?>
                        </div>
                        <div class="form-group col-md-12">
                        <label>Tipo: </label><br>
                        <?=$questao["tipo_texto"];?>
                        </div>
                        <?php
                        if ($questao["tipo"] == "2") {
                            $i = 1;
                            foreach($resposta as $r) {
                                if (
                                    (!empty($r["resposta"]) &&
                                    $r["resposta"] != "") ||
                                    $r["correta"] == "1"
                                ) {
                                    ?>
                                    <div class="form-group col-md-12">  
                                    <strong><label>Alternativa<?=($r["correta"] == "1")?" correta":"";?>: </label></strong><br>
                                    <?=$r["resposta"];?>
                                    </div>
                                    <?php
                                }
                                ?>                                
                                <?php
                                $i ++;
                            }
                        } else {
                            foreach($resposta as $r) {
                                ?>
                                <div class="form-group col-md-12">
                                    <label>Resposta:</label><br>
                                    <?=$r["resposta"];?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
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