<?php

namespace System\Core;

/*
 *------------------------
 * Router SysTeacher
 * ----------------------
 * Receive full request = QUERY_STRING
 * if invalid redirect to index
 * if valid redirect do controller->loader->view
 */

class Router
{
    private $controller;
    private $routes;
    private $request;
    private $param;

    function __construct($request = "index", $action = null, $action1 = null)
    {      
        if (!isset($this->routes) || !is_array($this->routes)) {
            $this->routes = array();
            $this->routes[] = "index";
        }
        /*
        *-------------------
        * Add routes here
        *-------------------
        */
        $this->routes[] = "registrar";
        $this->routes[] = "recuperar";
        $this->routes[] = "recuperarsenha";
        $this->routes[] = "homepage";
        $this->routes[] = "logout";

        //Banco de arquivos
        $this->routes[] = "categoria";
        $this->routes[] = "categoria_cadastrar";
        $this->routes[] = "categoria_editar";
        $this->routes[] = "categoria_excluir";
        $this->routes[] = "arquivo";
        $this->routes[] = "arquivo_cadastrar";
        $this->routes[] = "arquivo_editar";
        $this->routes[] = "arquivo_excluir";
        $this->routes[] = "arquivo_download";

        //Controle de classe
        $this->routes[] = "aluno";
        $this->routes[] = "aluno_cadastrar";
        $this->routes[] = "aluno_editar";
        $this->routes[] = "aluno_excluir";

        $this->routes[] = "turma";
        $this->routes[] = "turma_cadastrar";
        $this->routes[] = "turma_editar";
        $this->routes[] = "turma_excluir";
        $this->routes[] = "turma_gerenciar";        
        $this->routes[] = "turma_prova";
        $this->routes[] = "turma_diario";
        $this->routes[] = "turma_diario_cadastrar";
        $this->routes[] = "turma_diario_editar";
        $this->routes[] = "turma_diario_excluir";
        $this->routes[] = "turma_relatorio_individual";
        $this->routes[] = "turma_relatorio";

        $this->routes[] = "questao";
        $this->routes[] = "questao_cadastrar";
        $this->routes[] = "questao_editar";
        $this->routes[] = "questao_excluir";
        $this->routes[] = "questao_visualizar";
        $this->routes[] = "questao_feed";


        $this->routes[] = "getdisciplina";
        $this->routes[] = "getdisciplinafiltro";
        $this->routes[] = "getdisciplinafiltrofeed";
        $this->routes[] = "getconteudo";
        $this->routes[] = "getconteudofiltro";
        $this->routes[] = "getconteudofiltrofeed";

        if (!in_array($request, $this->routes)) {
            exit("Router: failed");
        }      
        
        $this->controller = new Controller($request, $action, $action1);

    }


}