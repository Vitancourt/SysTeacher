<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_turmas = $arr_dados["arr_turmas"]; 
} else {
    header("Location: /turma");
    exit();
}
$arr_diarios = $arr_dados["arr_diarios"];
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
                <h3 class="box-title">Listar diários - <?=$arr_turmas["descricao"]." - ".$arr_turmas["ano"];?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="turma-datatable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Faltas</th>
                        <th>Presenças</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php
                    if (!empty($arr_diarios)) {
                        foreach ($arr_diarios as $diarios) {
                        ?>
                        <tr>
                            <td>
                            <?=$diarios["data"];?>
                            </td>
                            <td><?=$diarios["faltas"];?></td>
                            <td><?=$diarios["presencas"];?></td>
                            <td style="padding-top: 2px;">
                            <a class="btn btn-info" 
                            href="/turma_diario_editar/<?=$arr_turmas["turma_id"];?>/<?=htmlentities($diarios["data_link"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Editar">
                                <i class="fa fa-edit"></i>
                            </a>                              
                            <a class="btn btn-danger" 
                            href="/turma_diario_excluir/<?=$arr_turmas["turma_id"];?>/<?=htmlentities($diarios["data_link"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Excluir">
                                <i class="fa fa-trash-o"></i>
                            </a>                            
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
<script>
    $(function () {
        $('#turma-datatable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            "scrollX": true,
            "language":{
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
            }
        });
    });
</script>
</body>
</html>