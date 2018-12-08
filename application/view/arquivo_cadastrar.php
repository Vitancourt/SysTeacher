<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "bancodearquivo";
require_once("menu_esquerdo.php");
if (empty($arr_dados)) {
    exit();
}
$arr_categorias = $arr_dados["arr_categorias"];
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
                        <h3 class="box-title">Cadastrar arquivo</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/arquivo_cadastrar" 
                        enctype="multipart/form-data">
                        <input type="hidden" name="arquivo[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <div class="col-md-12">
                            <div class="form-group col-md-5">
                            <label>Descrição: </label>
                                <input class="form-control" type="text" 
                                name="arquivo[descricao]" value="" 
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
                            <div class="form-group col-md-5">
                                <label>Arquivo</label>
                                <input class="form-control" type="file"
                                name="file">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <input name="form-arquivo" 
                            class="btn btn-info" type="submit" 
                            value="Cadastrar">
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