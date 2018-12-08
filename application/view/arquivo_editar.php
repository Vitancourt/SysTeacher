<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "bancodearquivo";
require_once("menu_esquerdo.php");
if (empty($arr_dados)) {
    exit();
}
$arr_categorias = $arr_dados["arr_categorias"];
$arr_arquivo = $arr_dados["arr_arquivo"];
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
      <?php
      require_once("arquivo_nav.php");
      ?>
      <section class="content">
            <div class="row">
            <div class="col-md-12">            
                  <div class="box">
                  <div class="box-header with-border">
                        <h3 class="box-title">Editar arquivo</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/arquivo_editar" 
                        enctype="multipart/form-data">
                        <input type="hidden" name="arquivo[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <input type="hidden" name="arquivo[arquivo_id]"
                        value="<?=htmlentities($arr_arquivo["arquivo_id"], ENT_QUOTES, "UTF-8");?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                            <label>Descrição: </label>
                                <input class="form-control" type="text" 
                                name="arquivo[descricao]" 
                                value="<?=htmlentities($arr_arquivo["descricao"], ENT_QUOTES, "UTF-8");?>" 
                                autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                                <label>Categoria:</label>
                                <select class="form-control"
                                name="arquivo[categoria_id]">
                                    <option value="">Sem categoria</option>
                                    <?php
                                    if ($arr_categorias) {
                                        foreach ($arr_categorias as $cat) {
                                            ?>
                                            <option 
                                            <?=($arr_arquivo["categoria_id"] == $cat["categoria_id"])?
                                            "selected":
                                            "";?>
                                            value="<?=$cat["categoria_id"];?>">
                                            <?=$cat["descricao"];?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Arquivo atual</label><br>
                            <label>
                            <a target="_blank" href=
                            "/<?=$arr_arquivo["link"];?>"
                            >Baixar</a>
                            </label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                                <label>Novo arquivo (Só faça upload de outro arquivo caso deseje alterá-lo)</label>
                                <input class="form-control" type="file"
                                name="file">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input name="form-arquivo" 
                            class="btn btn-info" type="submit" 
                            value="Gravar">
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
</html>