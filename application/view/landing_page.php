<?php
    if (isset($this->arr_dados["arr_turma"])) {
        $arr_turma = $this->arr_dados["arr_turma"];
    } else {
        $arr_turma = "0";
    }
    if (isset($this->arr_dados["arr_usuario"])) {
        $arr_usuario = $this->arr_dados["arr_usuario"];
    } else {
        $arr_usuario = "0";
    }
    if (isset($this->arr_dados["arr_arquivo"])) {
        $arr_arquivo = $this->arr_dados["arr_arquivo"];
    } else {
        $arr_arquivo = "0";
    }
    if (isset($this->arr_dados["arr_questao"])) {
        $arr_questao = $this->arr_dados["arr_questao"];
    } else {
        $arr_questao = "0";
    }
    
?>
<!-- Header -->
<header id="header">
<div class="container">
    <?php
    /*
    Logo
    <div id="logo" class="pull-left">
    <a href="index.html"><img src="<?=ASSETS_LANDING;?>img/logo-nav.png" alt="" title="" /></img></a>
    </div>
    */
    ?>

    <nav id="nav-menu-container">
    <ul class="nav-menu">
        <li><a href="#about">Sobre o sistema</a></li>
        <li><a href="#features">Funcionalidades</a></li>
    </ul>
    </nav>
    <!-- #nav-menu-container -->
</div>
</header>
<!-- #header -->

<!-- About -->

<section class="about" id="about">
<div class="container text-center">
    <h2>
        Sobre o SysTeacher
    </h2>

    <p>
    O SysTeacher é um sistema que visa auxiliar docentes em seu dia a dia, 
    oferecendo funcionalidades que agilizam e automatizam tarefas
    </p>

    <div class="row stats-row">
    <div class="stats-col text-center col-md-3 col-sm-6">
        <div class="circle">
        <span class="stats-no" data-toggle="counter-up"><?=$arr_usuario;?></span> Quantidade de usuários
        </div>
    </div>

    <div class="stats-col text-center col-md-3 col-sm-6">
        <div class="circle">
        <span class="stats-no" data-toggle="counter-up"><?=$arr_turma;?></span> Turmas cadastradas
        </div>
    </div>

    <div class="stats-col text-center col-md-3 col-sm-6">
        <div class="circle">
        <span class="stats-no" data-toggle="counter-up"><?=$arr_arquivo;?></span> Arquivos
        </div>
    </div>

    <div class="stats-col text-center col-md-3 col-sm-6">
        <div class="circle">
        <span class="stats-no" data-toggle="counter-up"><?=$arr_questao;?></span> Questões
        </div>
    </div>
    </div>
</div>
</section>
<!-- /About -->

<!-- Features -->

<section class="features" id="features">
<div class="container">
    <h2 class="text-center">
        Funcionalidades
    </h2>

    <div class="row">
    <div class="feature-col col-lg-4 col-xs-12">
        <div class="card card-block text-center">
        <div>
            <div class="feature-icon">
            <span class="fa fa-rocket"></span>
            </div>
        </div>

        <div>
            <h3>
            Design responsivo
            </h3>

            <p>
            Sistema que se adapta ao tamanho da tela
            </p>
        </div>
        </div>
    </div>

    <div class="feature-col col-lg-4 col-xs-12">
        <div class="card card-block text-center">
        <div>
            <div class="feature-icon">
            <span class="fa fa-envelope"></span>
            </div>
        </div>

        <div>
            <h3>
            Banco de questões
            </h3>

            <p>
            Compartilhe e procure questões para provas e simulados
            </p>
        </div>
        </div>
    </div>

    <div class="feature-col col-lg-4 col-xs-12">
        <div class="card card-block text-center">
        <div>
            <div class="feature-icon">
            <span class="fa fa-bell"></span>
            </div>
        </div>

        <div>
            <h3>
            Controle de classe
            </h3>

            <p>
            Controle suas turmas, alunos, notas
            </p>
        </div>
        </div>
    </div>
    </div>

    <div class="row">
    <div class="feature-col col-lg-4 col-xs-12">
        <div class="card card-block text-center">
        <div>
            <div class="feature-icon">
            <span class="fa fa-database"></span>
            </div>
        </div>

        <div>
            <h3>
            Banco de arquivos
            </h3>

            <p>
            Faça upload dos seus arquivos
            </p>
        </div>
        </div>
    </div>
    </div>
</div>
</section>
<!-- /Features -->

<!-- @component: footer -->

<footer class="site-footer">
<div class="bottom">
    <div class="container">
    <div class="row">

        <div class="col-lg-6 col-xs-12 text-lg-left text-center">
        </div>

        <div class="col-lg-6 col-xs-12 text-lg-right text-center">
        <ul class="list-inline">
            <li class="list-inline-item">
            <a href="/">Início</a>
            </li>

            <li class="list-inline-item">
            <a href="#about">Sobre o sistema</a>
            </li>

            <li class="list-inline-item">
            <a href="#features">Funcionalidades</a>
            </li>

        </ul>
        </div>

    </div>
    </div>
</div>
</footer>
<a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>


<!-- Required JavaScript Libraries -->
<script src="<?=ASSETS_LANDING;?>lib/jquery/jquery.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/jquery/jquery-migrate.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/superfish/hoverIntent.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/superfish/superfish.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/tether/js/tether.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/stellar/stellar.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/counterup/counterup.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/waypoints/waypoints.min.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/easing/easing.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/stickyjs/sticky.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/parallax/parallax.js"></script>
<script src="<?=ASSETS_LANDING;?>lib/lockfixed/lockfixed.min.js"></script>

<!-- Template Specisifc Custom Javascript File -->
<script src="<?=ASSETS_LANDING;?>js/custom.js"></script>

<script src="<?=ASSETS_LANDING;?>contactform/contactform.js"></script>

</body>
</html>
