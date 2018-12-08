<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados["arr_alunos"])
) {
    $arr_alunos = $arr_dados["arr_alunos"];
}
if (
    !empty($arr_dados["arr_turma"])
) {    
    $arr_turma = $arr_dados["arr_turma"];
}
if ($arr_turma["status"] == "2") {
    $flashMessages = new \Application\Model\FlashMessages;
    $flashMessages->adicionaMensagem("Turma já finalizada!", "2");
    header("Location: /turma");
    exit();
}
$aluno = new \Application\Model\Aluno;
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
                <h3 class="box-title">Gerenciar alunos</h3>
                <h3 class="box-title">Turma - <?=$arr_turma["descricao"]." - ".$arr_turma["ano"];?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="turma-datatable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data de nascimento</th>
                        <th>Estado</th>
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
                            <td>
                            <?php
                            if (
                                $aluno->verificaVinculo($arr_turma["turma_id"], $alunos["aluno_id"])
                            ){
                                ?>
                                <a class="btn btn-info"                             
                                data-toggle="modal" data-target="#modal-vincular"
                                onclick="mudaDados('<?=$alunos['nome'];?>', '<?=$alunos['aluno_id'];?>')">
                                    Vincular na turma
                                </a> 
                                <?php
                            } else {
                                ?>
                                <a class="btn btn-warning"                             
                                data-toggle="modal" data-target="#modal-desvincular"
                                onclick="mudaDadosDesvincular('<?=$alunos['nome'];?>', '<?=$alunos['aluno_id'];?>')">
                                    Desvincular da turma
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
        <!--Modal responsável pelo form vincular-->
        <div class="modal fade" id="modal-vincular" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Vincular aluno na turma</h4>
              </div>
              <form name="form-vincular" method="post" action="/turma_gerenciar">
              <div class="modal-body">
                <input type="hidden" name="vinculo[turma_id]" value="<?=$arr_turma["turma_id"];?>">
                <input type="hidden" id="vincular-id" name="vinculo[aluno_id]" value="">
                <input type="hidden" name="vinculo[token]" 
                value="<?=$this->token->generateToken();?>">
                <p>Deseja vincular o aluno <span id="vincular-nome"><span> na turma</p>                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" name="form-vincular" class="btn btn-primary">Confirmo</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!--Modal responsável pelo form desvincular-->
        <div class="modal fade" id="modal-desvincular" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Desvincular aluno na turma</h4>
              </div>
              <form name="form-desvincular" method="post" action="/turma_gerenciar">
              <div class="modal-body">
                <input type="hidden" name="vinculo[turma_id]" value="<?=$arr_turma["turma_id"];?>">
                <input type="hidden" id="desvincular-id" name="vinculo[aluno_id]" value="">
                <input type="hidden" name="vinculo[token]" 
                value="<?=$this->token->generateToken();?>">
                <p>Deseja desvincular o aluno <span id="desvincular-nome"><span> na turma</p>     
                <br>
                <span style="color:red">Observação: Ao confirmar a operação, os dados relacionados entre aluno
                <br>
                e turma serão apagados.</span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                <button type="submit" name="form-desvincular" class="btn btn-primary">Confirmo</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    </section>
</div>
<?php
require_once ("footer.php");
?>
<script>
    function mudaDados(nome_aluno, id_aluno) {
        $("#vincular-nome").html(nome_aluno);
        $("#vincular-id").val(id_aluno);
    }

    function mudaDadosDesvincular(nome_aluno, id_aluno) {
        $("#desvincular-nome").html(nome_aluno);
        $("#desvincular-id").val(id_aluno);
    }

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