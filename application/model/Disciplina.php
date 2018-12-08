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
class Disciplina
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
    private $disciplina_id;
    private $descricao;
    private $ciencia_id;

    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }

    /*
    *------------------------------------
    * Função responsável pegar as
    * disciplinas
    *-----------------------------------   
    */
    function getDisciplina($ciencia_id)
    {

        $sql = 
        "
        select
            *
        from
            disciplina
        where
            ciencia_id = :ciencia_id
        order by descricao asc
        ";
        $consulta = $this->database->prepare($sql);
        $consulta->bindParam(':ciencia_id', $ciencia_id, PDO::PARAM_INT);  
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
    * Função responsável pegar as
    * disciplinas
    *-----------------------------------   
    */
    function getDisciplinaFiltro($ciencia_id)
    {

        $sql = 
        "
        select
            d.disciplina_id,
            d.descricao
        from
            disciplina as d
        inner join questao as q
            on q.disciplina_id = d.disciplina_id
        where
            d.ciencia_id = :ciencia_id
        and
            q.usuario_id = :usuario_id
        group by d.disciplina_id
        order by d.descricao asc
        ";
        $consulta = $this->database->prepare($sql);
        $consulta->bindParam(':ciencia_id', $ciencia_id, PDO::PARAM_INT);  
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
    * Função responsável pegar as
    * disciplinas
    *-----------------------------------   
    */
    function getDisciplinaFiltroFeed($ciencia_id)
    {

        $sql = 
        "
        select
            d.disciplina_id,
            d.descricao
        from
            disciplina as d
        inner join questao as q
            on q.disciplina_id = d.disciplina_id
        where
            d.ciencia_id = :ciencia_id
        group by d.disciplina_id
        order by d.descricao asc
        ";
        $consulta = $this->database->prepare($sql);
        $consulta->bindParam(':ciencia_id', $ciencia_id, PDO::PARAM_INT);  
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