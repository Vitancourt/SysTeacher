<?php

namespace Application\Model;

/*
*------------------------------------
* Classe responsável pelas
* mensagem exibidas para o usuário
*-----------------------------------
*/
class FlashMessages
{
    
    function __construct()
    {
        if (!isset($_SESSION["ERRO"])) {
            $_SESSION["ERRO"] = array();
        }
        
        if (!isset($_SESSION["SUCESSO"])) {
            $_SESSION["SUCESSO"] = array();
        }
        
    }
    function limpaMensagemErro()
    {
        unset($_SESSION["ERRO"]);
    }
    function limpaMensagemSucesso()
    {
        unset($_SESSION["SUCESSO"]);
    }

   /*
   *------------------------------------
   * Função responsável por armazenar
   * as mensagem
   *-----------------------------------
   * @mensagem que será exibida
   * @tipo 1 = erro 2 = sucesso
   */
    function adicionaMensagem($mensagem, $tipo){
        if (!isset($_SESSION["ERRO"]) && $tipo == 2) {
            $_SESSION["ERRO"] = array();
        }
        if (!isset($_SESSION["SUCESSO"]) && $tipo == 1) {
            $_SESSION["SUCESSO"] = array();
        }
        if($tipo == 1) {
            $_SESSION["SUCESSO"][] = $mensagem;
        }
        if ($tipo == 2) {
        
            $_SESSION["ERRO"][] = $mensagem;
        }
    }

    function montaErro($erros)
    {
        $errosTotal = "";
        foreach ($erros as $er) {
            $errosTotal .= $er." <br> ";
        }
        if (!empty($errosTotal) && $errosTotal != "") {
            $errosTotal = "<div class='col-md-12' style='background-color: #dc3545; color: white;'>".$errosTotal."</div>";
            return $errosTotal;
            
        }
        return null;
    }

    function montaSucesso($sucessos)
    {
        $sucessosTotal = "";
        foreach ($sucessos as $suc) {
            $sucessosTotal .= $suc. " <br> ";
        }
        if (!empty($sucessosTotal) && $sucessosTotal != "") {
            $sucessosTotal = "<div class='col-md-12' style='background-color: #28a745; color: white;'>".$sucessosTotal."</div>";
            return $sucessosTotal;
        }
        return null;
        
    }

    function getMensagemErro()
    {
        if (isset($_SESSION["ERRO"])) {
            $erro = $this->montaErro($_SESSION["ERRO"]);
            $this->limpaMensagemErro();
            return $erro;
        }
        return null;
    }

    function getMensagemSucesso()
    {
        if (isset($_SESSION["SUCESSO"])) {
            $sucesso = $this->montaSucesso($_SESSION["SUCESSO"]);
            $this->limpaMensagemSucesso();
            return $sucesso;
        }
        return null;
    }
}
?>