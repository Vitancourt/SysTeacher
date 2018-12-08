<?php
require_once("landing_header.php");
?>
<body>
    <!-- Page Content
        ================================================== -->
    <!-- Hero -->
    <section class="hero">
        <div class="container text-center">
        <div class="row">
            <?php
            /*Logo
            <div class="col-md-12">
            <a class="hero-brand" href="index.php" title="Home"><img alt="SysTeacher Logo" src="img/logo.png"></a>
            </div>
            */
            ?>
        </div>

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
        <form name="form-registrar" method="post" action="/registrar"> 
            <input type="hidden" name="registro[token]" value="<?=$this->token->generateToken();?>">
            <div class="form-group">
            <label>Cadastre-se</label>
            </div>
            <div class="form-group">
            <label>Email:</label>
            <input class="form-control" type="email" name="registro[email]" 
            autocomplete="off" required>
            </div>
            <div class="form-group">
            <label>Senha: (Mais de 8 caracteres)</label>
            <input class="form-control" type="password" name="registro[password]"
            required>
            </div>    
            <div class="form-group">
            <label>Repita a senha:</label>
            <input class="form-control" type="password" name="registro[password_repeat]"
            required>
            </div>  
            <div class="form-group">        
            <button name="form-registrar" class="btn btn-info" type="submit">Registrar-se</button>
            <a href="/" class="btn btn-info">Voltar</a>
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