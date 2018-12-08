<?php
require_once("header.php");
require_once("menu_topo.php");
$active = "turma";
require_once("menu_esquerdo.php");
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
                        <h3 class="box-title">Cadastrar turma</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <form method="post" action="/turma_cadastrar">
                        <input type="hidden" name="turma[token]" 
                        value="<?=$this->token->generateToken();?>">
                        <div class="col-md-12">
                              <div class="form-group col-md-12">
                              <label>Descricao: </label>
                              <input class="form-control" type="text" 
                              name="turma[descricao]" value="" 
                              autocomplete="off" required>
                              </div>
                              <div class="form-group col-md-4">
                              <label>Ano:</label>
                              <input class="form-control" type="number" 
                              name="turma[ano]" value="<?=date("Y");?>">  
                              </div>      
                              <div class="col-md-12"></div>                   
                              <div class="form-group col-md-2">
                              <label>Quantidade de avaliações: </label>
                              <select class="form-control" required
                              name="turma[quantidade_avaliacao]">
                                 <option value="3">3</option>
                                 <option value="2">2</option>
                                 <option value="1">1</option>
                              </select>                                                                                                                    
                              </div>
                              <div class="form-group col-md-12">
                              <input name="form-turma" 
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