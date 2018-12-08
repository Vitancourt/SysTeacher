<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    if (isset($arr_dados["arr_turmas"])) {
        $arr_turma = $arr_dados["arr_turmas"];
    }
    if (isset($arr_dados["arr_alunos"])) {
        $arr_aluno = $arr_dados["arr_alunos"];
    }
    if (isset($arr_dados["arr_nota"])) {
        $arr_nota = $arr_dados["arr_nota"];
    }
    if (isset($arr_dados["arr_media"])) {
        $arr_media = $arr_dados["arr_media"];
    }
    if (isset($arr_dados["arr_diario"])) {
        $arr_diario = $arr_dados["arr_diario"];
    }
}
$nota = new \Application\Model\Nota;
$diario = new \Application\Model\Diario;
?>
<style>
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
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
                <h3 class="box-title">Relatório da turma - <?=$arr_turma["descricao"]." - ".$arr_turma["ano"];?></h3><br>
                <h3 class="box-title"><?=$arr_aluno["nome_completo"];?></h3>
                <br>
                <a class="btn btn-warning no-print" 
                onclick="window.print()"><i class="fa fa-print"></i>           
                Imprimir
                </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <h3 class="box-title">Notas</h3>
                <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <?php
                        $i = 1;
                        while ($i <= $arr_turma["quantidade_avaliacao"]) {
                            ?>
                            <th>Nota <?=$i;?></th>
                            <?php
                            $i ++;
                        }
                        ?>      
                        <th>
                            Média
                        </th>                  
                    </tr>
                </thead>
                <tbody>              
                    <tr>
                        <?php
                        $i = 1;
                        while ($i <= $arr_turma["quantidade_avaliacao"]) {
                            ?>
                            <td>
                                <?php
                                if (isset($arr_nota)) {
                                    foreach($arr_nota as $nota) {
                                        if ($nota["numero"] == $i) {
                                            echo $nota["valor"];
                                        }
                                    }
                                }                                
                                ?>
                            </td>
                            <?php
                            $i ++;
                        }
                        ?>      
                        <td>
                            <?php
                            if (isset($arr_media)) {
                                echo $arr_media;
                            }
                            ?>
                        </td>
                    </tr>               
                </tbody>
                </table>
                <h3 class="box-title">Diário</h3>
                <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>  
                        <th>
                            Data
                        </th>
                        <th>
                            Situação
                        </th>
                    </tr>
                </thead>
                <tbody>                                  
                    <?php
                    if (isset($arr_diario)) {
                        foreach ($arr_diario as $diario) {                                
                            ?>
                            <tr>
                            <td>
                            <?=$diario["data"];?>
                            </td>
                            <td>
                            <?=$diario["situacao"];?>
                            </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>                                
                </tbody>
                </table>
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