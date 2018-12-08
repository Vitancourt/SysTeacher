<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_notas = $arr_dados["arr_notas"];
    $arr_turma = $arr_dados["arr_turma"];
    $arr_avaliacao = $arr_dados["arr_avaliacao"];
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
                <h3 class="box-title">Gerenciar Notas da prova - </h3>
                <h3 class="box-title">Turma - <?=$arr_turma["descricao"]." - ".$arr_turma["ano"];?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <form method="post" action="/turma_prova/<?=$_GET["action"];?>/<?=$_GET["action1"];?>" name="form-prova">
                <input type="hidden" name="avaliacao[token]" 
                value="<?=$this->token->generateToken();?>">
                <input type="hidden" name="avaliacao[turma_id]" 
                value="<?=$arr_turma["turma_id"];?>">
                <input type="hidden" name="avaliacao[numero]"
                value="<?=$_GET["action1"];?>">
                <input type="hidden" name="avaliacao[avaliacao_id]" 
                value="<?=$arr_avaliacao["avaliacao_id"];?>">
                <div class="form-group col-md-12">
                    <label>Descrição:</label>
                    <input type="text" name="avaliacao[descricao]" 
                    value="<?=$arr_avaliacao["descricao"];?>">
                </div>
                <table id="turma-datatable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nota</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php
                    if (!empty($arr_notas)) {
                        foreach ($arr_notas as $notas) {                        
                        ?>                        
                        <tr>
                            <td>
                            <?=$notas["nome"];?>
                            <input type="hidden" name="nota[<?=$notas["aluno_id"];?>][aluno_id]"
                            value="<?=$notas["aluno_id"];?>">
                            <input type="hidden" name="nota[<?=$notas["aluno_id"];?>][avaliacao_id]"
                            value="<?=$notas["avaliacao_id"];?>">
                            <input type="hidden" name="nota[<?=$notas["aluno_id"];?>][nota_id]"
                            value="<?=$notas["nota_id"];?>">
                            <input type="hidden" name="nota[<?=$notas["aluno_id"];?>][turma_id]"
                            value="<?=$arr_turma["turma_id"];?>">
                            </td>
                            <td>
                            <input type="number" 
                            min="0" max="100"
                            name="nota[<?=$notas["aluno_id"];?>][valor]"
                            value="<?=(empty($notas["valor"]) || $notas["valor"] == "")?
                            "0":$notas["valor"];?>">
                            </td>                                                 
                        </tr>
                        <?php
                        }
                    }
                    ?>                
                </tbody>
                </table>
                <div class="col-md-12"></div>
                <button class="btn btn-info" name="form-prova" type="submit">Gravar</button>
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
        $('#turma-datatable').DataTable({
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": true,
            //"scrollX": true,
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