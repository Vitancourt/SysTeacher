<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "categoria";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_alunos = $arr_dados["arr_alunos"];
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
                <h3 class="box-title">Listar alunos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="aluno-datatable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de nascimento</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php
                    if (!empty($arr_alunos)) {
                        foreach ($arr_alunos as $alunos) {
                        ?>
                        <tr>
                            <td>
                            <?=$alunos["nome"];?>
                            </td>
                            <td>
                            <?=$alunos["datanascimento"];?>
                            </td>
                            <td style="padding-top: 2px;">
                            <a class="btn btn-info" 
                            href="aluno_editar/<?=htmlentities($alunos["aluno_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Editar">
                                <i class="fa fa-edit"></i>
                            </a>  
                            <a class="btn btn-danger" 
                            href="aluno_excluir/<?=htmlentities($alunos["aluno_id"], ENT_QUOTES, "UTF-8");?>"
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
        $('#aluno-datatable').DataTable({
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