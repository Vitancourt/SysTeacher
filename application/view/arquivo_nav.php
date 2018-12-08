<section class="content-header">
   <ol class="breadcrumb">
      <li><a href="/homepage"><i class="fa fa-dashboard"></i> Homepage</a></li>
      <li class="active">Listar arquivos</li>
   </ol>
   <div class="container-fluid" style="margin-bottom:4px">
      <div class="col-md-12">
            <a class="btn btn-info" href="/arquivo_cadastrar" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Cadastrar arquivo">
            <i class="fa fa-plus"></i>           
               Cadastrar arquivo
               </a>
            <a class="btn btn-warning" href="/arquivo" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Listar arquivos">          
               <i class="fa fa-navicon"></i>           
               Listar arquivos  
            </a>
      </div>
   </div>
   <?=$this->flashMessages->getMensagemSucesso();?>
   <?=$this->flashMessages->getMensagemErro();?>
</section>