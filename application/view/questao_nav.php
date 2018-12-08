<section class="content-header">
   <ol class="breadcrumb">
      <li><a href="/homepage"><i class="fa fa-dashboard"></i> Homepage</a></li>
      <li class="active">Listar questões</li>
   </ol>
   <div class="container-fluid" style="margin-bottom:4px">
      <div class="col-md-12">
            <a class="btn btn-info" href="/questao_cadastrar" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Cadastrar questão">          
            <i class="fa fa-plus"></i>           
               Cadastrar questão
            </a>
            <a class="btn btn-warning" href="/questao" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Listar questões">          
               <i class="fa fa-navicon"></i>           
               Listar questões
            </a>
      </div>
   </div>
   <?=$this->flashMessages->getMensagemSucesso();?>
   <?=$this->flashMessages->getMensagemErro();?>
</section>