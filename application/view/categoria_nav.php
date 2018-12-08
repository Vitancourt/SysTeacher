<section class="content-header">
   <ol class="breadcrumb">
      <li><a href="/homepage"><i class="fa fa-dashboard"></i> Homepage</a></li>
      <li class="active">Listar categorias</li>
   </ol>
   <div class="container-fluid" style="margin-bottom:4px">
      <div class="col-md-12">
            <a class="btn btn-info" href="/categoria_cadastrar" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Cadastrar categoria">          
            <i class="fa fa-plus"></i>           
               Cadastrar categoria 
               </a>
            <a class="btn btn-warning" href="/categoria" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Listar categorias">          
               <i class="fa fa-navicon"></i>           
               Listar categorias   
            </a>
      </div>
   </div>
   <?=$this->flashMessages->getMensagemSucesso();?>
   <?=$this->flashMessages->getMensagemErro();?>
</section>