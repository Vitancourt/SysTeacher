<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * de Aluno
 *-----------------------------------
*/
class Aluno
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
    private $aluno_id;
    private $primeiro_nome;
    private $segundo_nome;
    private $ultimo_nome;
    private $datanascimento;
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
    * registrar um aluno
    *-----------------------------------
    * @post form
    */
    public function insertAluno($post = null) 
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["primeiro_nome"]) ||
            $post["primeiro_nome"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo primeiro nome é obrigatório!", 
                "2"
            );
        }
        if (strlen($post["primeiro_nome"]) > 50) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo do primeiro nome é 50 caracteres", 
                "2"
            );
        }
        if (
            !empty($post["segundo_nome"]) &&
            $post["segundo_nome"] != ""
        ) {
            if (strlen($post["segundo_nome"]) > 50) {
                $valida = false;
                $this->flashMessages->adicionaMensagem(
                    "Tamanho máximo do segundo nome é 50 caracteres", 
                    "2"
                );
            }
        }
        if (
            empty($post["ultimo_nome"]) ||
            $post["ultimo_nome"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo último nome é obrigatório!", 
                "2"
            );
        }
        if (strlen($post["ultimo_nome"]) > 50) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo do primeiro nome é 50 caracteres", 
                "2"
            );
        }
        $data = true;
        if (
            empty($post["datanascimento"]) ||
            $post["datanascimento"] == "" ||
            $post["datanascimento"] == "00/00/0000"
        ) {
            $data = false;
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo data nascimento é obrigatório!", 
                "2"
            );
        }
        if ($data) {
            if (!$post["datanascimento"] = $this->validaDataUsuario($post["datanascimento"])) {
                $valida = false;
                $this->flashMessages->adicionaMensagem(
                    "O campo data nascimento está incorreto. Formato(20/07/2000)", 
                    "2"
                );
            }
        }
        if (!$valida) {
            return false;
        }    
        $sql = 
        "insert into aluno
        (primeiro_nome,
        segundo_nome,
        ultimo_nome,
        datanascimento,
        usuario_id)
        values
        (:primeiro_nome, 
        :segundo_nome,
        :ultimo_nome,
        :datanascimento,
        :usuario_id)
        ";
        $consulta = $this->database->prepare($sql);      
        $consulta->bindParam(':primeiro_nome', $post["primeiro_nome"], PDO::PARAM_STR);
        $consulta->bindParam(':segundo_nome', $post["segundo_nome"], PDO::PARAM_STR);
        $consulta->bindParam(':ultimo_nome', $post["ultimo_nome"], PDO::PARAM_STR);
        $consulta->bindParam(':datanascimento', $post["datanascimento"], PDO::PARAM_STR);
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);    
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){       
                    $this->flashMessages->adicionaMensagem(
                    "Aluno cadastrado!", 
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
    * alunos e tratar filtros
    *-----------------------------------   
    */
    function getAlunos()
    {
        $sql = 
        "select 
            *,
            concat_ws(' ', primeiro_nome, segundo_nome, ultimo_nome) as nome,
            date_format(datanascimento, '%d/%m/%Y') as datanascimento
        from 
            aluno
        where
            usuario_id = :usuario_id
            order by nome asc
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
    * alunos por turma_id
    *-----------------------------------   
    */
    function getAlunosByTurmaId($turma_id)
    {
        $sql = 
        "select 
            al.aluno_id,
            concat_ws(' ', al.primeiro_nome, al.segundo_nome, al.ultimo_nome) as nome,
            date_format(al.datanascimento, '%d/%m/%Y') as datanascimento,
            vin.vinculo_id
        from 
            aluno as al
        inner join vinculo as vin ON
            vin.aluno_id = al.aluno_id
        where
            al.usuario_id = :usuario_id
        AND	
            vin.turma_id = :turma_id
        order by nome asc
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
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
    * Função responsável por pegar
    * todas aluno pelo id
    *-----------------------------------   
    */
    function getAlunoById($aluno_id)
    {
        $sql = 
        "select 
            *,
            date_format(datanascimento, '%d/%m/%Y') as datanascimento,
            concat_ws(' ', primeiro_nome, segundo_nome, ultimo_nome) as nome_completo
        from 
            aluno
        where
            usuario_id = :usuario_id
        and
            aluno_id = :aluno_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
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
    * dar update em um aluno
    *-----------------------------------
    * @post form
    */
    public function updateAluno($post = null) 
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["aluno_id"]) ||
            $post["aluno_id"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Erro de identificação!", 
                "2"
            );
        }
        if (
            empty($post["primeiro_nome"]) ||
            $post["primeiro_nome"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo primeiro_nome é obrigatório!", 
                "2"
            );
        }
        if (strlen($post["primeiro_nome"]) > 200) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo do primeiro_nome é 50 caracteres", 
                "2"
            );
        }
        if (
            !empty($post["segundo_nome"]) &&
            $post["segundo_nome"] != ""
        ) {
            if (strlen($post["segundo_nome"]) > 50) {
                $valida = false;
                $this->flashMessages->adicionaMensagem(
                    "Tamanho máximo do segundo nome é 50 caracteres", 
                    "2"
                );
            }
        }
        if (
            empty($post["ultimo_nome"]) ||
            $post["ultimo_nome"] == ""
        ) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo último nome é obrigatório!", 
                "2"
            );
        }
        if (strlen($post["ultimo_nome"]) > 50) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo do primeiro nome é 50 caracteres", 
                "2"
            );
        }
        $data = true;
        if (
            empty($post["datanascimento"]) ||
            $post["datanascimento"] == "" ||
            $post["datanascimento"] == "00/00/0000"
        ) {
            $data = false;
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "O campo data nascimento é obrigatório!", 
                "2"
            );
        }
        if ($data) {
            if (!$post["datanascimento"] = $this->validaDataUsuario($post["datanascimento"])) {
                $valida = false;
                $this->flashMessages->adicionaMensagem(
                    "O campo data nascimento está incorreto. Formato(20/07/2000)", 
                    "2"
                );
            }
        }
        if (!$valida) {
            return false;
        }    
        $sql = 
        "update aluno set
            primeiro_nome = :primeiro_nome,
            segundo_nome = :segundo_nome,
            ultimo_nome = :ultimo_nome,
            datanascimento = :datanascimento
        where
            usuario_id = :usuario_id
        and
            aluno_id = :aluno_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);      
        $consulta->bindParam(':primeiro_nome', $post["primeiro_nome"], PDO::PARAM_STR);
        $consulta->bindParam(':segundo_nome', $post["segundo_nome"], PDO::PARAM_STR);
        $consulta->bindParam(':ultimo_nome', $post["ultimo_nome"], PDO::PARAM_STR);
        $consulta->bindParam(':datanascimento', $post["datanascimento"], PDO::PARAM_STR);
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);  
        $consulta->bindParam(':aluno_id', $post["aluno_id"], PDO::PARAM_INT);  
        try{
            $consulta->execute();
            $this->flashMessages->adicionaMensagem(
                "Aluno editado!", 
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
    * excluir um aluno
    *-----------------------------------   
    */
    function deleteAluno($post)
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["aluno_id"]) ||
            $post["aluno_id"] == ""
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
            aluno
        where
            usuario_id = :usuario_id
        and
            aluno_id = :aluno_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql); 
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $post["aluno_id"], PDO::PARAM_INT);
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
    * Função responsável por pegar
    * alunos para o vincular
    *-----------------------------------   
    */
    function getAlunosGerenciar($turma_id)
    {
        $sql = 
        "select 
            al.aluno_id,
            concat_ws(' ', al.primeiro_nome, al.segundo_nome, al.ultimo_nome) as nome,
            date_format(al.datanascimento, '%d/%m/%Y') as datanascimento
        from 
            aluno as al
        where
            al.usuario_id = :usuario_id
            order by nome asc
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
    * alunos para o vincular
    *-----------------------------------   
    */
    function getAlunosVincular($turma_id)
    {
        $sql = 
        "select 
            al.aluno_id,
            concat_ws(' ', al.primeiro_nome, al.segundo_nome, al.ultimo_nome) as nome,
            date_format(al.datanascimento, '%d/%m/%Y') as datanascimento,
            vin.vinculo_id
        from 
            aluno as al
        inner join vinculo as vin
            on vin.aluno_id = al.aluno_id
        where
            al.usuario_id = :usuario_id
        and
            vin.turma_id = :turma_id
            order by nome asc
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
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
    * alunos para o vincular
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
                return false;
            }
            return true;
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