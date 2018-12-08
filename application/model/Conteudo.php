<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * das conteudo
 *-----------------------------------
*/
class Conteudo
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
    private $conteudo_id;
    private $descricao;
    private $disciplina_id;

    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }
    /*
    *------------------------------------
    * Função responsável pegar os
    * conteudos
    *-----------------------------------   
    */
    function getConteudo($disciplina_id)
    {

        $sql = 
        "
        select
            *
        from
            conteudo
        where
            disciplina_id = :disciplina_id
        order by descricao asc
        ";
        $consulta = $this->database->prepare($sql);
        $consulta->bindParam(':disciplina_id', $disciplina_id, PDO::PARAM_INT);  
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
    * Função responsável pegar os
    * conteudos
    *-----------------------------------   
    */
    function getConteudoFiltro($disciplina_id)
    {

        $sql = 
        "
        select
            c.conteudo_id,
            c.descricao
        from
            conteudo as c
        inner join questao as q
            on q.conteudo_id = c.conteudo_id
        where
            c.disciplina_id = :disciplina_id
        and
            q.usuario_id = :usuario_id
        order by c.descricao asc
        ";
        $consulta = $this->database->prepare($sql);
        $consulta->bindParam(':disciplina_id', $disciplina_id, PDO::PARAM_INT);  
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
    * Função responsável pegar os
    * conteudos feed
    *-----------------------------------   
    */
    function getConteudoFiltroFeed($disciplina_id)
    {

        $sql = 
        "
        select
            c.conteudo_id,
            c.descricao
        from
            conteudo as c
        inner join questao as q
            on q.conteudo_id = c.conteudo_id
        where
            c.disciplina_id = :disciplina_id
        order by c.descricao asc
        ";
        $consulta = $this->database->prepare($sql);
        $consulta->bindParam(':disciplina_id', $disciplina_id, PDO::PARAM_INT);   
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