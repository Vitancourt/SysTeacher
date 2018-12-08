<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_turmas = $arr_dados["arr_turmas"];
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
                <h3 class="box-title">Listar turmas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="turma-datatable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Ano</th>
                        <th>Avaliações</th>
                        <th>Gerenciamento</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php
                    if (!empty($arr_turmas)) {
                        foreach ($arr_turmas as $turmas) {
                        ?>
                        <tr>
                            <td>
                            <?=$turmas["descricao"];?>
                            </td>
                            <td>
                            <?=$turmas["ano"];?>
                            </td>
                            <td>
                            <?php
                            if ($turmas["status"] == "1") {
                                for ($i = 1; $i <= $turmas["quantidade_avaliacao"]; $i++) {
                                    ?>
                                    <a class="btn btn-info" style="margin-bottom: 3px;"
                                    href="turma_prova/<?=htmlentities($turmas["turma_id"], ENT_QUOTES, "UTF-8");?>/<?=$i;?>"
                                    data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Gerenciar Prova">
                                        Gerenciar prova <?=$i;?>
                                    </a> 
                                    <br>
                                    <?php
                                }
                            }                            
                            ?>
                            </td>
                            <td>
                            <a class="btn btn-info" 
                            href="turma_gerenciar/<?=htmlentities($turmas["turma_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Gerenciar Alunos">
                                Gerenciar alunos
                            </a>  
                            <br>
                            <a class="btn btn-info" style="margin-top: 3px;" 
                            href="turma_diario/<?=htmlentities($turmas["turma_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Gerenciar diário">
                                Gerenciar diário
                            </a> 
                            </td>
                            <td style="padding-top: 2px;">
                            <a class="btn btn-warning" 
                            href="turma_relatorio/<?=htmlentities($turmas["turma_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left"
                            target="_blank" data-content="Visualizar">
                                <i class="fa fa-print"></i>
                            </a>  
                            <?php
                            if ($turmas["status"] == "1") {
                                ?>
                                <a class="btn btn-info" 
                                href="turma_editar/<?=htmlentities($turmas["turma_id"], ENT_QUOTES, "UTF-8");?>"
                                data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>                              
                                <a class="btn btn-danger" 
                                href="turma_excluir/<?=htmlentities($turmas["turma_id"], ENT_QUOTES, "UTF-8");?>"
                                data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Excluir">
                                    <i class="fa fa-trash-o"></i>
                                </a> 
                                <?php
                            }
                            ?>                            
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