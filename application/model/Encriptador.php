<?php

namespace Application\Model;

/*
*------------------------------------
* Classe responsável por encriptar
* os dados
*-----------------------------------
*/

class Encriptador
{
    function __construct()
    {
    }
    
    /*
    *------------------------------------
    * Função responsável por encriptar
    * os dados
    *-----------------------------------
    *@senha do usuário
    *return senha encriptada
    */
    public static function encriptar($senha){
        define("PW_HASH", "$1$2c3bfbbc3123asdbas70cae16ba57626d7$");
        return sha1(crypt($senha, PW_HASH));
    }
}
?>