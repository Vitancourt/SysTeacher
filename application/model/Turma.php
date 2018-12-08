<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * de Turma
 *-----------------------------------
*/
class Turma
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
    private $turma_id;
    private $descricao;
    private $ano;
    private $quantidade_avaliacao;
    private $status;
    private $usuario_id;

    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }

    /*
     *Função que trata data
     */
    public function validaDataUsuario($data)
    {
        $data = explode("/", $data);
        if (!is_array($data)) {
            return false;
        }
        if (
            isset($data[0]) &&
            isset($data[1]) &&
            isset($data[2])
        ) {
            if (!checkdate($data[1], $data[0], $data[2])) {
                return false;
            }
            return ($data[2]."-".$data[1]."-".$data[0]);
        }else {
            return false;
        }
    }


    /*
    *------------------------------------
    * Função responsável por validar e 
    * registrar uma turma
    *-----------------------------------
    * @post form
    */
    public function insertTurma($post = null) 
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["descricao"]) ||
            $post["descricao"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo descricao é obrigatório!", 
                "2"
            );
        }
        if (strlen($post["descricao"]) > 100) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo da descrição é 100 caracteres", 
                "2"
            );
        }   
        if (
            empty($post["ano"]) ||
            $post["ano"] == "" ||
            !is_numeric($post["ano"])
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo ano é obrigatório!", 
                "2"
            );
        }
        if (
            empty($post["quantidade_avaliacao"]) ||
            $post["quantidade_avaliacao"] == "" ||
            !is_numeric($post["quantidade_avaliacao"]) ||
            ($post["quantidade_avaliacao"] < 1 || $post["quantidade_avaliacao"] > 3)
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo quantidade de avaliações está incorreto!", 
                "2"
            );
        }
        if (!$valida) {
            return false;
        }    
        $sql = 
        "insert into turma
        (descricao,
        ano,
        quantidade_avaliacao,
        status,
        usuario_id)
        values
        (:descricao, 
        :ano,
        :quantidade_avaliacao,
        '1',
        :usuario_id)
        ";
        $consulta = $this->database->prepare($sql);      
        $consulta->bindParam(':descricao', $post["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':ano', $post["ano"], PDO::PARAM_STR);
        $consulta->bindParam(':quantidade_avaliacao', $post["quantidade_avaliacao"], PDO::PARAM_STR);
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);    
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){       
                    $this->flashMessages->adicionaMensagem(
                    "Turma cadastrado!", 
                    "1"
                    );      
                    $this->database->commit();
                    return $this->database->lastInsertId();				                
            }
            return false;
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $this->database->rollBack();
            return false;
        }	
    }

    /*
    *------------------------------------
    * Função responsável por pegar
    * turmas e tratar filtros
    *-----------------------------------   
    */
    function getTurmas()
    {
        $sql = 
        "select 
            *
        from 
            turma
         where 
            usuario_id = :usuario_id
            order by ano desc
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável por pegar
    * turma pelo id
    *-----------------------------------   
    */
    function getTurmaById($turma_id)
    {
        $sql = 
        "select 
            *
        from 
            turma
        where
            usuario_id = :usuario_id
        and
            turma_id = :turma_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){        
                foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $l){
                        return $l;
                }
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
    * Função responsável por validar e 
    * dar update em uma turma
    *-----------------------------------
    * @post form
    */
    public function updateTurma($post = null) 
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["turma_id"]) ||
            $post["turma_id"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Erro de identificação!", 
                "2"
            );
        }
        if (
            empty($post["descricao"]) ||
            $post["descricao"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo primeiro_nome é obrigatório!", 
                "2"
            );
        }
        if (strlen($post["descricao"]) > 200) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo da descrição é 200 caracteres", 
                "2"
            );
        }
        if (
            empty($post["ano"]) ||
            $post["ano"] == "" ||
            !is_numeric($post["ano"])
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo ano é obrigatório!", 
                "2"
            );
        }
        /*if (
            empty($post["quantidade_avaliacao"]) ||
            $post["quantidade_avaliacao"] == "" ||
            !is_numeric($post["quantidade_avaliacao"]) ||
            ($post["quantidade_avaliacao"] < 1 || $post["quantidade_avaliacao"] > 3)
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo quantidade de avaliações está incorreto!", 
                "2"
            );
        }*/

        if (!$valida) {
            return false;
        }    
        $sql = 
        "update turma set
            descricao = :descricao,
            ano = :ano
        ";
        //$sql .=", quantidade_avaliacao = :quantidade_avaliacao ";
        $sql .= "        
        where
            usuario_id = :usuario_id
        and
            turma_id = :turma_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);      
        $consulta->bindParam(
            ':descricao', 
            $post["descricao"],
            PDO::PARAM_STR
        );
        $consulta->bindParam(
            ':ano', 
            $post["ano"], 
            PDO::PARAM_INT
        );
        /*$consulta->bindParam(
            ':quantidade_avaliacao', 
            $post["quantidade_avaliacao"], 
            PDO::PARAM_INT
        );*/        
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(
            ':usuario_id', 
            $usuario_id, 
            PDO::PARAM_INT
        );  
        $consulta->bindParam(
            ':turma_id', 
            $post["turma_id"],
            PDO::PARAM_INT
        );  
        try{
            $consulta->execute();
            $this->flashMessages->adicionaMensagem(
                "Turma editada!", 
                "1"
            );      
            $this->database->commit();
            return $this->database->lastInsertId();	
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $this->database->rollBack();
            return false;
        }	
    }


    /*
    *------------------------------------
    * Função responsável por 
    * excluir uma turma
    *-----------------------------------   
    */
    function deleteTurma($post)
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["turma_id"]) ||
            $post["turma_id"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Falha na identificação!", 
                "2"
            );
        }
        if (!$valida) {
            return false;
        }
        $sql = 
        "delete from
            turma
        where
            usuario_id = :usuario_id
        and
            turma_id = :turma_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql); 
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':turma_id', $post["turma_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            $this->database->commit();
            $this->flashMessages->adicionaMensagem(
                "Registro excluído", 
                "1"
            );
            return true;
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $this->database->rollBack();
            return false;
        }	
    }

    /*
    *------------------------------------
    * Função responsável por verificar
    * se o aluno já não está vínculado
    * a turma
    *-----------------------------------   
    */
    function verificaVinculo($turma_id, $aluno_id)
    {
        $sql = 
        "select 
            *
        from 
            vinculo
        where 
            turma_id = :turma_id
        and
            aluno_id = :aluno_id
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return true;
                //return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável por verificar
    * se o aluno é do logado
    *-----------------------------------   
    */
    function verificaAlunoSession($aluno_id)
    {
        $sql = 
        "select 
            *
        from 
            aluno
        where 
            usuario_id = :usuario_id
        and
            aluno_id = :aluno_id
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return true;
                //return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável por verificar
    * se a turma é do logado
    *-----------------------------------   
    */
    function verificaTurmaSession($turma_id)
    {
        $sql = 
        "select 
            *
        from 
            turma
        where 
            usuario_id = :usuario_id
        and
            turma_id = :turma_id
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return true;
                //return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável por verificar
    * vincular aluno
    *-----------------------------------   
    */
    function vinculaAluno($post)
    {
        $valida = true;
        if (empty($post["turma_id"])) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Erro ao transferir o identificador", 
                "2"
            );
        }
        if (empty($post["aluno_id"])) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Erro ao transferir o identificador", 
                "2"
            );
        }
        if ($valida) {
            if (
                $this->verificaVinculo($post["turma_id"], $post["aluno_id"]) ||
                !$this->verificaAlunoSession($post["aluno_id"]) ||
                !$this->verificaTurmaSession($post["turma_id"])
            ){
                $valida = false;
                $this->flashMessages->adicionaMensagem(
                    "Erro na operação", 
                    "2"
                );
            }
        }
        if (!$valida) {
            return false;
        }

        $sql = 
        "insert into
            vinculo
            (aluno_id, turma_id)
        values
            (:aluno_id, :turma_id)
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':turma_id', $post["turma_id"], PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $post["aluno_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return true;
                //return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável por verificar
    * desvincular aluno
    *-----------------------------------   
    */
    function desvinculaAluno($post)
    {
        $valida = true;
        if (empty($post["turma_id"])) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Erro ao transferir o identificador", 
                "2"
            );
        }
        if (empty($post["aluno_id"])) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Erro ao transferir o identificador", 
                "2"
            );
        }
        if ($valida) {
            if (
                !$this->verificaVinculo($post["turma_id"], $post["aluno_id"]) ||
                !$this->verificaAlunoSession($post["aluno_id"]) ||
                !$this->verificaTurmaSession($post["turma_id"])
            ){
                $valida = false;
                $this->flashMessages->adicionaMensagem(
                    "Erro na operação", 
                    "2"
                );
            }
        }
        if (!$valida) {
            return false;
        }

        $sql = 
        "delete from
            vinculo
        where 
            aluno_id = :aluno_id
        and
            turma_id = :turma_id
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':turma_id', $post["turma_id"], PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $post["aluno_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return true;
                //return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável os vinculos
    *-----------------------------------   
    */
    function getVinculos($turma_id)
    {
        $sql = 
        "select 
            * 
        from 
            vinculo 
        where 
            turma_id = :turma_id
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
                            /*foreach($linha as $l){
                return $l["usuario_id"];
                }*/
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
    * Função responsável por contar
    * turmas para landing
    *-----------------------------------   
    */
    function count()
    {
        $sql = 
        "select 
            COUNT(turma_id) as quantidade
        from 
            turma 
        ";
        $consulta = $this->database->prepare($sql);   
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $l) {
                    return $l["quantidade"];
                }
            }
            return "0";
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