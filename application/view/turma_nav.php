<section class="content-header">
   <ol class="breadcrumb">
      <li><a href="/homepage"><i class="fa fa-dashboard"></i> Homepage</a></li>
      <li class="active">Listar turmas</li>
   </ol>
   <div class="container-fluid" style="margin-bottom:4px">
      <div class="col-md-12">
            <a class="btn btn-info" href="/turma_cadastrar" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Cadastrar turma">          
            <i class="fa fa-plus"></i>           
               Cadastrar turma
               </a>
            <a class="btn btn-warning" href="/turma" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Listar turmas">          
               <i class="fa fa-navicon"></i>           
               Listar turmas
            </a>
      </div>
   </div>
   <?=$this->flashMessages->getMensagemSucesso();?>
   <?=$this->flashMessages->getMensagemErro();?>
</section>