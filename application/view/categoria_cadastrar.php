<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "categoria";
require_once("menu_esquerdo.php");
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
      <?php
      require_once("categoria_nav.php");
      ?>
      <section class="content">
            <div class="row">
            <div class="col-md-12">            
                  <div class="box">
                  <div class="box-header with-border">
                        <h3 class="box-title">Cadastrar categoria</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/categoria_cadastrar">
                        <input type="hidden" name="categoria[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <div class="col-md-12">
                              <div class="form-group col-md-5">
                              <label>Categoria: </label>
                              <input class="form-control" type="text" 
                              autocomplete="off"
                              name="categoria[descricao]" value="" required>
                              </div>
                              <div class="form-group col-md-12">
                              <input name="form-categoria" 
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
</html>