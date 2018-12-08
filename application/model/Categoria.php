<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * de categoria
 *-----------------------------------
*/
class Categoria
{
      /*
       *Variáveis de controle
       */
      private $database;
      private $flashMessages;
      private $session;
      /*
       *Variáveis de objeto
       */
      private $categoria_id;
      private $descricao;
      private $criacao;
      private $usuario_id;


      public function __construct()
      {
            $this->database = \Application\Model\Database::conectar();
            $this->flashMessages = new \Application\Model\FlashMessages;
            $this->session = new \Application\Model\Session;
      }

      /*
      *------------------------------------
      * Função responsável por validar e 
      * registrar uma categoria de arquivo
      *-----------------------------------
      * @post form
      */
      public function insertCategoria($post) 
      {
            $this->database->beginTransaction();
            $valida = true;
            if ($this->getCategoriaByDescricao($post["descricao"])) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "Essa categoria já existe", 
                        "2"
                  );
            }
            if (
                  empty($post["descricao"]) ||
                  $post["descricao"] == ""
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "O campo descrição é obrigatório!", 
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
            if (!$valida) {
                 return false;
            }     
            $sql = 
            "insert into categoria
            (descricao,
            usuario_id)
            values
            (:descricao, 
            :usuario_id)
            ";
            $consulta = $this->database->prepare($sql);      
            $consulta->bindParam(':descricao', $post["descricao"], PDO::PARAM_STR);
            $usuario_id = $this->session->getSession();
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            try{
            $consulta->execute();
            if($consulta->rowCount() > 0){       
                  $this->flashMessages->adicionaMensagem(
                  "Categoria cadastrada!", 
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
      * todas as categorias
      *-----------------------------------   
      */
      function getCategoria()
      {
            $sql = 
            "select 
            *
            from 
            categoria
            where
            usuario_id = :usuario_id
            order by descricao asc
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
      * todas as categorias
      *-----------------------------------   
      */
      function getCategoriaById($categoria_id)
      {
            $sql = 
            "select 
            *
            from 
            categoria
            where
            usuario_id = :usuario_id
            and
            categoria_id = :categoria_id
            limit 1
            ";
            $consulta = $this->database->prepare($sql);   
            $usuario_id = $this->session->getSession();   
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $consulta->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
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
      * Função responsável por pegar
      * uma categoria pela descricao
      *-----------------------------------   
      */
      function getCategoriaByDescricao($descricao)
      {
            $sql = 
            "select 
            categoria_id
            from 
            categoria
            where
            descricao = :descricao
            and
            usuario_id = :usuario_id
            ";
            $consulta = $this->database->prepare($sql);   
            $consulta->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $usuario_id = $this->session->getSession();   
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
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
      * Função responsável por pegar
      * editar uma categoria
      *-----------------------------------   
      */
      function updateCategoria($post)
      {
            $this->database->beginTransaction();
            $valida = true;
            if ($post["descricao"] != $post["descricao_old"]) {
                  if ($this->getCategoriaByDescricao($post["descricao"])) {
                        $valida = false;
                        $this->flashMessages->adicionaMensagem(
                        "Essa categoria já existe", 
                        "2"
                        );
                  }
            }
            if (
                  empty($post["descricao"]) ||
                  $post["descricao"] == ""
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "O campo descrição é obrigatório!", 
                        "2"
                  );
            }
            if (strlen($post["descricao"]) > 100) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "Tamanho máximo da descrição é 100", 
                        "2"
                  );
            }
            if (!$valida) {
                  return false;
            }
            $sql = 
            "update
            categoria
            set
            descricao = :descricao
            where
            usuario_id = :usuario_id
            and
            categoria_id = :categoria_id
            limit 1
            ";
            $consulta = $this->database->prepare($sql); 
            $consulta->bindParam(':descricao', $post["descricao"], PDO::PARAM_STR);  
            $usuario_id = $this->session->getSession();   
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $consulta->bindParam(':categoria_id', $post["categoria_id"], PDO::PARAM_INT);
            try{
                  $consulta->execute();
                  $this->database->commit();
                  $this->flashMessages->adicionaMensagem(
                        "Alterações gravadas", 
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
      * excluir uma categoria
      *-----------------------------------   
      */
      function deleteCategoria($post)
      {
            $this->database->beginTransaction();
            $valida = true;
            if (
                  empty($post["categoria_id"]) ||
                  $post["categoria_id"] == ""
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
            categoria
            where
            usuario_id = :usuario_id
            and
            categoria_id = :categoria_id
            limit 1
            ";
            $consulta = $this->database->prepare($sql); 
            $usuario_id = $this->session->getSession();   
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $consulta->bindParam(':categoria_id', $post["categoria_id"], PDO::PARAM_INT);
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

}