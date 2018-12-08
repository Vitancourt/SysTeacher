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
    <?php
    require_once("questao_nav.php");
    ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">            
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Excluir questão</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form method="post" action="/questao_excluir" name="form-questao">
                        <input type="hidden" name="questao[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="questao[questao_id]"
                        value="<?=$questao["questao_id"];?>">
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
                                    ?>
                                    <div class="form-group col-md-12">  
                                    <label>Alternativa <?=$i;?></label> <?=($r["correta"] == "1")?"<strong>Correta</strong>":"";?><br>
                                    <?=$r["resposta"];?>
                                    </div>
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
                            <div class="form-group col-md-12">
                            <input name="form-questao" 
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