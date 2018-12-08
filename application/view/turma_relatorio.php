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
                <h3 class="box-title">Relatório da turma - <?=$arr_turma["descricao"]." - ".$arr_turma["ano"];?></h3>
                <br>
                <a class="btn btn-warning no-print" 
                onclick="window.print()"><i class="fa fa-print"></i>           
                Imprimir
                </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Faltas</th>
                        <th>Presenças</th>
                        <th>Média</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php
                    if (!empty($arr_aluno)) {
                        foreach ($arr_aluno as $aluno) {
                        ?>
                        <tr>
                            <td>
                            <?=$aluno["nome"];?>
                            <a class="btn btn-warning no-print" target="_blank"
                            href="/turma_relatorio_individual/<?=$arr_turma["turma_id"]."/".$aluno["aluno_id"];?>"">
                            <i class="fa fa-print"></i>           
                            Relatório individual
                            </a>
                            </td>
                            <?php
                            $linha = $diario->getDiarioAluno($arr_turma["turma_id"], $aluno["aluno_id"]);
                            ?>
                            <td>
                            <?=$linha["faltas"];?>
                            </td>
                            <td>
                            <?=$linha["presencas"];?>
                            </td>
                            <td>
                            <?=$nota->getMedia($aluno["aluno_id"], $arr_turma["turma_id"], $arr_turma["quantidade_avaliacao"]);?>
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