<?php

namespace Application\Model;

/*
 *------------------------------------
 * Função responsável por criar o
 * CSRK token de uso único
 *-----------------------------------
*/
class Token
{

    /**  
     * Start session with class instance
     */ 
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();            
        }
        if (!isset($_SESSION["CSRF"])) {
            $_SESSION["CSRF"] = array();            
        }        
        if (!is_array($_SESSION["CSRF"])) {
            $_SESSION["CSRF"] = array();
        }
    }

    /*
    *------------------------------------
    * Gera um token aleatório
    *-----------------------------------
    */
    function generateToken()
    {
        if (
            isset($_SESSION["CSRF"]) &&
            is_array($_SESSION["CSRF"])           
        ){
            $token = md5(uniqid (rand (), true));
            array_push($_SESSION["CSRF"], $token);        
        }
        return $token;        
    }

    /*
    *------------------------------------
    * Verifica se o token é valido
    *-----------------------------------
    */
    function verifyToken($csrf)
    {
        if (in_array($csrf, $_SESSION["CSRF"])) {
            $position = array_search($csrf, $_SESSION["CSRF"]);
            unset($_SESSION["CSRF"][$position]);
            return  true;
        }
        return false;
    }


}