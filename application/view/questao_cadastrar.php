<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "questao";
require_once("menu_esquerdo.php");
if (
    !empty($arr_dados)
) {
    $arr_ciencia = $arr_dados["arr_ciencia"];
}
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
                        <h3 class="box-title">Cadastrar questao</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/questao_cadastrar" name="form-questao">
                        <input type="hidden" name="questao[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-4">
                            <label>Ciência: </label>
                                <select class="form-control" name="questao[ciencia]" id="ciencia" required>
                                    <option value="">- Selecione -</option>
                                    <?php
                                    foreach ($arr_ciencia as $ciencia) {
                                    ?>
                                    <option value="<?=$ciencia["ciencia_id"];?>">
                                        <?=$ciencia["descricao"];?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label>Disciplina: </label>
                                <select class="form-control" name="questao[disciplina]"
                                id="select-disciplina" required>
                                    <option value="">Selecione uma ciência</option>
                                    <span id="loading-disciplina">                                   
                                    </span>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label>Conteúdo: </label>
                                <select class="form-control" name="questao[conteudo]"
                                id="select-conteudo" required>
                                    <option value="">Selecione uma disciplina</option>
                                    <span id="loading-conteudo">                                
                                    </span>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Questão</label>
                                <textarea class="form-control"
                                name="questao[descricao]"
                                id="descricao"></textarea>
                            </div>
                            <script>
                            var editor = CKEDITOR.replace( 'descricao' );
                            CKFinder.setupCKEditor( editor );
                            </script>
                            <div class="form-group col-md-12">
                            <label>Tipo</label><br>
                            <label><input type="radio" checked name="questao[tipo]" value="1" onchange="verifica(this)">Descritiva</label> 
                            <label><input type="radio" name="questao[tipo]" value="2"onchange="verifica(this)">Objetiva</label>
                            </div>
                            <div class="form-group col-md-12" id="descritiva">
                                <label>Resposta descritiva</label>
                                <textarea class="form-control"
                                name="descritiva[resposta]"
                                id="resposta_descritiva"></textarea>
                                <script>
                                var editor = CKEDITOR.replace( 'resposta_descritiva' );
                                CKFinder.setupCKEditor( editor );
                                </script>
                            </div>                            
                            <div class="form-group col-md-12" id="objetiva" style="display:none;">
                                <label style="color:red;"><strong>Use a quantidade necessária de alternativas de 1 a 5.</strong></label><br>
                                <label>Alternativa correta:</label>
                                <label>&nbsp;1&nbsp;<input type="radio" checked name="correta" value="1"></label>
                                <label>&nbsp;2&nbsp;<input type="radio" name="correta" value="2"></label>
                                <label>&nbsp;3&nbsp;<input type="radio" name="correta" value="3"></label>
                                <label>&nbsp;4&nbsp;<input type="radio" name="correta" value="4"></label>
                                <label>&nbsp;5&nbsp;<input type="radio" name="correta" value="5"></label>
                                <br>
                                <label>Alternativa 1</label>
                                <textarea class="form-control"
                                name="objetiva[1]"
                                id="alternativa_1"></textarea>
                                <script>
                                var editor = CKEDITOR.replace( 'alternativa_1' );
                                CKFinder.setupCKEditor( editor );
                                </script>
                                <br>
                                <label>Alternativa 2</label>
                                <textarea class="form-control"
                                name="objetiva[2]"
                                id="alternativa_2"></textarea>
                                <script>
                                var editor = CKEDITOR.replace( 'alternativa_2' );
                                CKFinder.setupCKEditor( editor );
                                </script>
                                <br>
                                <label>Alternativa 3</label>
                                <textarea class="form-control"
                                name="objetiva[3]"
                                id="alternativa_3"></textarea>
                                <script>
                                var editor = CKEDITOR.replace( 'alternativa_3' );
                                CKFinder.setupCKEditor( editor );
                                </script>
                                <label>Alternativa 4</label>
                                <textarea class="form-control"
                                name="objetiva[4]"
                                id="alternativa_4"></textarea>
                                <script>
                                var editor = CKEDITOR.replace( 'alternativa_4' );
                                CKFinder.setupCKEditor( editor );
                                </script>
                                <br>
                                <label>Alternativa 5</label>
                                <textarea class="form-control"
                                name="objetiva[5]"
                                id="alternativa_5"></textarea>
                                <script>
                                var editor = CKEDITOR.replace( 'alternativa_5' );
                                CKFinder.setupCKEditor( editor );
                                </script>
                            </div>
                            <div class="form-group col-md-12">
                            <input name="form-questao" 
                            class="btn btn-info" type="submit" value="Cadastrar">
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
function verifica(radio) {
    if (radio.value == "1") {
        $("#objetiva").hide();
        $("#descritiva").show();
    } else if (radio.value == "2") {
        $("#objetiva").show();
        $("#descritiva").hide();
    }
}
</script>
</html>