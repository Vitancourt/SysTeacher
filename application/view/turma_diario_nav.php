<section class="content-header">
   <ol class="breadcrumb">
      <li><a href="/homepage"><i class="fa fa-dashboard"></i> Homepage</a></li>
      <li><a href="/turma"><i class="fa fa-dashboard"></i> Turmas</a></li>
      <li class="active">Listar diários</li>
   </ol>
   <div class="container-fluid" style="margin-bottom:4px">
      <div class="col-md-12">
            <a class="btn btn-info" href="/turma_diario_cadastrar/<?=$arr_turmas["turma_id"];?>" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Cadastrar diário">          
            <i class="fa fa-plus"></i>           
               Cadastrar diário
            </a>
            <a class="btn btn-warning" href="/turma_diario/<?=$arr_turmas["turma_id"];?>" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Listar diários">          
               <i class="fa fa-navicon"></i>           
               Listar diários
            </a>
            <a class="btn btn-primary" href="/turma" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Voltar">          
               <i class="fa fa-navicon"></i>           
               Voltar
            </a>
      </div>
   </div>
   <?=$this->flashMessages->getMensagemSucesso();?>
   <?=$this->flashMessages->getMensagemErro();?>
</section>