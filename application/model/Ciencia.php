<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * das ciencia
 *-----------------------------------
*/
class Ciencia
{
    /*
     * Variáveis de controle
     */
    private $database;
    private $flashMessages;
    private $session;
    /*
     * Variáveis de objeto
     */
    private $ciencia_id;
    private $descricao;

    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }

    /*
    *------------------------------------
    * Função responsável pegar as ciencias
    *-----------------------------------   
    */
    function getCiencia()
    {

        $sql = 
        "
        select
            *
        from
            ciencia
        order by descricao asc
        ";
        $consulta = $this->database->prepare($sql);   
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            return false;
        }	
    }

    /*
    *------------------------------------
    * Função responsável pegar as ciencias
    *-----------------------------------   
    */
    function getCienciaFiltro()
    {

        $sql = 
        "
        select
            c.ciencia_id,
            c.descricao
        from
            ciencia as c
        inner join questao as q
            on q.ciencia_id = c.ciencia_id
        where
            q.usuario_id = :usuario_id
        group by c.ciencia_id
        order by c.descricao asc
        ";
        $consulta = $this->database->prepare($sql); 
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);  
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            return false;
        }	
    }


    /*
    *------------------------------------
    * Função responsável pegar as ciencias
    *-----------------------------------   
    */
    function getCienciaFiltroFeed()
    {

        $sql = 
        "
        select
            c.ciencia_id,
            c.descricao
        from
            ciencia as c
        inner join questao as q
            on q.ciencia_id = c.ciencia_id
        group by c.ciencia_id
        order by c.descricao asc
        ";
        $consulta = $this->database->prepare($sql); 
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            return false;
        }	
    }
   
}