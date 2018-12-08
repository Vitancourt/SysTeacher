<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "questao";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_ciencia = $arr_dados["arr_ciencia"];
    $arr_conteudo = $arr_dados["arr_conteudo"];
    $arr_disciplina = $arr_dados["arr_disciplina"];
    $questao = $arr_dados["arr_questao"];
}
$obj_questao = new \Application\Model\Questao;
?>
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
                        <h3 class="box-title">Editar questao</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/questao_editar" name="form-questao">
                        <input type="hidden" name="questao[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="questao[questao_id]" value="<?=$questao["questao_id"];?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-4">
                            <label>Ciência: </label>
                                <select class="form-control" name="3" id="ciencia" disabled>
                                    <option value="">- Selecione -</option>
                                    <?php
                                    foreach ($arr_ciencia as $ciencia) {
                                    ?>
                                    <option <?=($ciencia["ciencia_id"] == $questao["ciencia_id"])?"selected":""?>
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
                                <select class="form-control" name="2"
                                id="select-disciplina" disabled>
                                    <option value="">Selecione uma ciência</option >
                                    <span id="loading-disciplina">                                
                                    </span>
                                    <?php
                                    foreach ($arr_disciplina as $disciplina) {
                                    ?>
                                    <option <?=($discilpina["disciplina_id"] == $questao["disciplina_id"])?"selected":""?>
                                    value="<?=$disciplina["disciplina_id"];?>">
                                        <?=$disciplina["descricao"];?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label>Conteúdo: </label>
                                <select class="form-control" name="1"
                                id="select-conteudo" disabled>
                                    <option value="">Selecione uma disciplina</option>
                                    <span id="loading-conteudo">                                
                                    </span>
                                    <?php
                                    foreach ($arr_conteudo as $conteudo) {
                                    ?>
                                    <option <?=($conteudo["conteudo_id"] == $questao["conteudo_id"])?"selected":""?>
                                    value="<?=$conteudo["conteudo_id"];?>">
                                        <?=$conteudo["descricao"];?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Questão</label>
                                <textarea class="form-control"
                                name="questao[descricao]"
                                id="descricao"><?=$questao["descricao"];?></textarea>
                            </div>
                            <script>
                            var editor = CKEDITOR.replace( 'descricao' );
                            CKFinder.setupCKEditor( editor );
                            </script>
                            <div class="form-group col-md-12">
                            <label>Tipo</label><br>
                            <?php
                            if ($questao["tipo"] == "1") {
                                foreach ($obj_questao->getQuestaoResposta($questao["questao_id"], $questao["tipo"]) as $resposta) {
                                    $descritiva = $resposta["resposta"];
                                }
                                ?>
                                <label><input type="radio" checked name="questao[tipo]" value="1">Descritiva</label> 
                                <div class="form-group col-md-12" id="descritiva">
                                    <label>Resposta descritiva</label>
                                    <textarea class="form-control"
                                    name="descritiva[]"
                                    id="resposta_descritiva"><?=$descritiva;?></textarea>
                                    <input type="hidden" name="descritiva_id" value="<?=$resposta["resposta_descritiva_id"];?>">
                                    <script>
                                    var editor = CKEDITOR.replace( 'resposta_descritiva' );
                                    CKFinder.setupCKEditor( editor );
                                    </script>
                                </div>
                                </div>
                                <?php
                            } else  {
                                ?>
                                <label><input type="radio" checked name="questao[tipo]" value="2">Objetiva</label>
                                </div>
                                <div class="form-group col-md-12" id="objetiva">
                                    <?php
                                    $i = 1;
                                    foreach ($obj_questao->getQuestaoResposta($questao["questao_id"], $questao["tipo"]) as $resposta) {
                                        ?>
                                        <label>Alternativa <?=$i;?></label> <?=($resposta["correta"] == "1")?"<strong>Correta</strong>":"";?>
                                        <textarea class="form-control"
                                        name="objetiva[<?=$i;?>][resposta]"
                                        id="alternativa_<?=$i;?>"><?=$resposta["resposta"];?></textarea>
                                        <input type="hidden" name="objetiva[<?=$i;?>][resposta_objetiva_id]" 
                                        value="<?=$resposta["resposta_objetiva_id"];?>">
                                        <script>
                                        var editor = CKEDITOR.replace( 'alternativa_<?=$i;?>' );
                                        CKFinder.setupCKEditor( editor );
                                        </script>
                                        <br>
                                        <?php
                                        $i ++;
                                    }
                                    ?>                            
                                </div>
                                <?php
                            }
                            ?>                            
                            <div class="form-group col-md-12">
                            <input name="form-questao" 
                            class="btn btn-info" type="submit" value="Alterar">
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
<script>
$('#ciencia').change(function(e){
    var ciencia = $("#ciencia").val();
    var select = document.getElementById("select-disciplina");
    $('#loading-disciplina').html('Aguarde, carregando...');  		
    $.getJSON('/getdisciplina/'+ciencia, function (dados){
        if (dados.length > 0){ 	
    $("#select-disciplina").html("<option value=''>- Selecione -</option>");
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
    $('#loading-conteudo').html('Aguarde, carregando...');  		
    $.getJSON('/getconteudo/'+disciplina, function (dados){
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
</html>