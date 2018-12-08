<?php
require_once("landing_header.php");
?>
<body>
    <!-- Page Content
        ================================================== -->
    <!-- Hero -->

    <section class="hero">
        <div class="container text-center">
        <div class="col-md-12">
            <h1>
            Seu software de auxílio
            </h1>
        </div>
        <div class="row">
        <?=$this->flashMessages->getMensagemSucesso();?>
        <?=$this->flashMessages->getMensagemErro();?>
        <div class="col-md-3 col-xl-3">
        </div>
        <div class="col-md-6 col-md-offset-3 col-xl-6 col-xl-offset-3">   
        <form name="form-login" method="post" action="/">   
            <input type="hidden" name="login[token]" 
            value="<?=$this->token->generateToken();?>">        
            <div class="form-group">
            <label>Acesse o sistema</label>
            </div>
            <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="email" name="login[email]"
            autocomplete="off" required>
            </div>
            <div class="form-group">
            <label>Senha:</label>
            <input class="form-control" type="password" name="login[password]" required>
            </div>    
            <div class="form-group">        
            <button name="form-login" class="btn btn-info" type="submit">Entrar</button>
            <a href="/registrar" class="btn btn-info">Registre-se</a>
            <a href="/recuperar" class="btn btn-info">Esqueci minha senha</a>
            </div>
        </form>
        </div>
        </div>
        </div>
    </section>
    <!-- /Hero -->
<?php
require_once("landing_page.php");
?>