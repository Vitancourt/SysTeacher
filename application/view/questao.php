<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "questao";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    if (isset($arr_dados["arr_questao"])) {
        $arr_questao = $arr_dados["arr_questao"];
    }    
    if (isset($arr_dados["arr_ciencia"])) {
        $arr_ciencia = $arr_dados["arr_ciencia"];
    }
    if (isset($arr_dados["arr_disciplina"])) {
        $arr_disciplina = $arr_dados["arr_disciplina"];
    }
    if (isset($arr_dados["arr_conteudo"])) {
        $arr_conteudo = $arr_dados["arr_conteudo"];
    }
    if (isset($arr_dados["filtro"])) {
        $filtro = $arr_dados["filtro"];
    }
}
$obj_questao = new \Application\Model\Questao;
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
                <h3 class="box-title">Listar questões</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="col-md-12">
                    <form method="post" action="/questao" name="form-filtro">
                    <label>Filtros:</label>
                    <br>
                    <div class="form-group col-md-4">
                    <label>Ciência: </label>
                        <select class="form-control" name="filtro[ciencia]" id="ciencia" required>
                            <option value="">- Selecione -</option>
                            <?php
                            foreach ($arr_ciencia as $ciencia) {
                            ?>
                            <option 
                            <?=(
                                isset($filtro["ciencia"]) &&
                                $filtro["ciencia"] == $ciencia["ciencia_id"]
                            )?"selected":"";?>
                            value="<?=$ciencia["ciencia_id"];?>">
                                <?=$ciencia["descricao"];?>
                            </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Disciplina: </label>
                        <select class="form-control" name="filtro[disciplina]"
                        id="select-disciplina">
                            <option value="">Selecione uma ciência</option>
                            <span id="loading-disciplina">  
                            <?php
                            if (
                                isset($arr_disciplina)
                            ) {
                                foreach ($arr_disciplina as $d) {
                                    ?>
                                    <option <?=(
                                        isset($filtro["disciplina"]) &&
                                        $filtro["disciplina"] == $d["disciplina_id"]
                                    )?"selected":"";?>
                                    value="<?=$d["disciplina_id"];?>"
                                    ><?=$d["descricao"];?></option>
                                    <?php
                                }
                            }
                            ?>                                 
                            </span>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                    <label>Conteúdo: </label>
                        <select class="form-control" name="filtro[conteudo]"
                        id="select-conteudo">
                            <option value="">Selecione uma disciplina</option>
                            <span id="loading-conteudo">  
                            <?php
                            if (
                                isset($arr_conteudo)
                            ) {
                                foreach ($arr_conteudo as $c) {
                                    ?>
                                    <option <?=(
                                        isset($filtro["conteudo"]) &&
                                        $filtro["conteudo"] == $c["conteudo_id"]
                                    )?"selected":"";?>
                                    value="<?=$c["conteudo_id"];?>"
                                    ><?=$c["descricao"];?></option>
                                    <?php
                                }
                            }
                            ?>
                            </span>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                    <input name="form-filtro" 
                    class="btn btn-info" type="submit" value="Filtrar">
                    </div> 
                    </form>
                </div>
                <table id="turma-datatable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Questão</th>
                        <th width="12%">Ação</th>
                    </tr>
                </thead>
                <tbody>              
                    <?php
                    if (!empty($arr_questao)) {
                        foreach ($arr_questao as $questao) {
                        ?>
                        <tr>
                            <td>
                            <strong>Tipo de questão:<br></strong>
                            <?=$questao["tipo_texto"];?><br>
                            <strong>Questão:<br></strong>
                            <?=$questao["descricao"];?><br>
                            <strong>Resposta:<br></strong>
                            <?php
                            $i = 1;
                            foreach ($obj_questao->getQuestaoResposta($questao["questao_id"], $questao["tipo"]) as $resposta) {
                                if ($questao["tipo"] == "1") {
                                    echo $resposta["resposta"];
                                } elseif ($questao["tipo"] == "2") {   
                                    if (
                                        (!empty($resposta["resposta"]) &&
                                        $resposta["resposta"] != "") ||
                                        $resposta["correta"] == "1"
                                    ) {                              
                                        $txt = "<strong>Alternativa" ;
                                        if ($resposta["correta"] == "1") {
                                            $txt.=" correta:";
                                        } else {
                                            $txt.=":</strong>";
                                        }       
                                        echo $txt;                       
                                        echo "<br>".$resposta["resposta"]."<br>";
                                    }                        
                                    $i++;
                                }
                            }
                            ?>
                            <br>
                            </td>
                            <td style="padding-top: 2px;">
                            <a class="btn btn-warning" 
                            href="/questao_visualizar/<?=htmlentities($questao["questao_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left"
                            target="_blank" data-content="Visualizar">
                                <i class="fa fa-print"></i>
                            </a>  
                            <a class="btn btn-info" 
                            href="questao_editar/<?=htmlentities($questao["questao_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Editar">
                                <i class="fa fa-edit"></i>
                            </a>                              
                            <a class="btn btn-danger" 
                            href="questao_excluir/<?=htmlentities($questao["questao_id"], ENT_QUOTES, "UTF-8");?>"
                            data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Excluir">
                                <i class="fa fa-edit"></i>
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

$('#ciencia').change(function(e){
    var ciencia = $("#ciencia").val();
    var select = document.getElementById("select-disciplina");
    $('#select-disciplina').html("<option value=''>- Selecione uma ciência -</option>");  
    $('#select-conteudo').html("<option value=''>- Selecione uma disciplina -</option>");  			
    $.getJSON('/getdisciplinafiltro/'+ciencia, function (dados){
        if (dados.length > 0){ 	
            $("#select-disciplinafiltro").html("<option value=''>-Selecione-</option>");
                dados.forEach(function(valor, chave){          
                var option = document.createElement("option");
                option.setAttribute("value", valor.disciplina_id);
                var txtnode = document.createTextNode(valor.descricao);
                option.appendChild(txtnode);
                select.appendChild(option);         
                $('#loading-disciplina').html("");   
            });               
        }else{
            $("loading-disciplina").html("Erro ao carregar as disciplinas, selecione novamente a ciência!");
        }
    })
})
$('#select-disciplina').change(function(e){
    var disciplina = $("#select-disciplina").val();
    var select = document.getElementById("select-conteudo");
    $('#select-conteudo').html("<option value=''>- Selecione uma ciência -</option>");
    $.getJSON('/getconteudofiltro/'+disciplina, function (dados){
        if (dados.length > 0){ 	
            $("#select-conteudo").html("<option value=''>- Selecione -</option>");
                dados.forEach(function(valor, chave){          
                var option = document.createElement("option");
                option.setAttribute("value", valor.conteudo_id);
                var txtnode = document.createTextNode(valor.descricao);
                option.appendChild(txtnode);
                select.appendChild(option);         
                $('#loading-conteudo').html("");   
            });               
        }else{
            $("loading-conteudo").html("Erro ao carregar os conteúdos, selecione novamente a disciplina!");
        }
    })
})
</script>
</body>
</html>