<section class="content-header">
   <ol class="breadcrumb">
      <li><a href="/homepage"><i class="fa fa-dashboard"></i> Homepage</a></li>
      <li class="active">Listar alunos</li>
   </ol>
   <div class="container-fluid" style="margin-bottom:4px">
      <div class="col-md-12">
            <a class="btn btn-info" href="/aluno_cadastrar" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Cadastrar aluno">          
            <i class="fa fa-plus"></i>           
               Cadastrar aluno
               </a>
            <a class="btn btn-warning" href="/aluno" 
            data-toggle="popover" data-trigger="hover" data-placement="bottom" 
            data-content="Listar alunos">          
               <i class="fa fa-navicon"></i>           
               Listar alunos
            </a>
      </div>
   </div>
   <?=$this->flashMessages->getMensagemSucesso();?>
   <?=$this->flashMessages->getMensagemErro();?>
</section>