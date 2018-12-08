<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * de usuário
 *-----------------------------------
*/
class Usuario
{

      private $database;
      private $flashMessages;

      public function __construct()
      {
            $this->database = \Application\Model\Database::conectar();
            $this->flashMessages = new \Application\Model\FlashMessages;
      }

      /*
      *------------------------------------
      * Função responsável por validar e 
      * registrar um usuário
      *-----------------------------------
      * @post form
      */
      public function registrarUsuario($post) 
      {
            $valida = true;
            if (
                  empty($post["email"]) ||
                  $post["email"] == ""
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "O campo email é obrigatório e deve ser válido!", 
                        "2"
                  );
            }
            if (
                  empty($post["password"]) ||
                  $post["password"] == ""
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "O campo senha é obrigatório e deve ser válido!", 
                        "2"
                  );
            }

            if (
                  empty($post["password_repeat"]) ||
                  $post["password_repeat"] == ""
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "O campo repita senha é obrigatório e deve ser válido!", 
                        "2"
                  );
            }

            if (
                  $post["password"] != $post["password_repeat"]
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "As senhas não coincidem!", 
                        "2"
                  );
            }
            if ($this->verificarEmail($post["email"])) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "Este email já está em uso!", 
                        "2"
                  );
            }
            if (!$valida) {
                  return false;
            }     
            $sql = 
            "insert into usuario
            (email,
            senha,
            hash)
            values
            (:email, 
            :senha, 
            :hash)
            ";
            $consulta = $this->database->prepare($sql);      
            $consulta->bindParam(':email', $post["email"], PDO::PARAM_STR);
            $encriptador = new \Application\Model\Encriptador;
            $senha = $encriptador->encriptar($post["password"]);
            $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
            $hash = md5(uniqid (rand (), true));
            $consulta->bindParam(':hash', $hash, PDO::PARAM_STR);
            try{
                  $consulta->execute();
                  if($consulta->rowCount() > 0){
                        $email = new \Application\Model\Email;
                        $email->registrar(
                              $this->database->lastInsertId(), 
                              $hash, 
                              $post["email"]
                        );
                        return true;				                
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
      * se já existe um email cadastrado
      *-----------------------------------
      * @email para verificar
      */
      function verificarEmail($email)
      {
            $sql = 
            "select 
            usuario_id 
            from 
            usuario
            where
            email = :email
            limit 1
            ";
            $consulta = $this->database->prepare($sql);      
            $consulta->bindParam(':email', $email, PDO::PARAM_STR);
            try{
                  $consulta->execute();
                  if($consulta->rowCount() > 0){
                        return true;				                
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
      * Função responsável por validar
      * a criação da conta
      *-----------------------------------
      * @usuario_id
      * @hash
      * ambos parametros servem para 
      * verificação no banco de dados
      */
      function validarConta($usuario_id, $hash)
      {
            $sql = 
            "select 
                  usuario_id 
            from 
                  usuario
            where
                  usuario_id = :usuario_id
            and
                  hash = :hash
            limit 1
            ";
            $consulta = $this->database->prepare($sql);      
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $consulta->bindParam(':hash', $hash, PDO::PARAM_STR);
            try{
                  $consulta->execute();
                  if($consulta->rowCount() > 0){
                        return $this->ativarContaDestruirHash($usuario_id);
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
      * Função responsável por ativar
      * a nova conta
      *-----------------------------------
      * @usuario_id verificação no 
      * banco de dados
      */
      function ativarContaDestruirHash($usuario_id)
      {
            $sql = 
            "update
                  usuario
            set         
                  ativo = '1',
                  hash = ''
            where
                  usuario_id = :usuario_id
            limit 1
            ";
            $hash = md5(uniqid (rand (), true));
            $consulta = $this->database->prepare($sql);      
            $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            try{
                  $consulta->execute();
                  if($consulta->rowCount() > 0){            
                        return true;				                
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
      * Função responsável criar uma hash
      * que irá para link de recuperação
      *-----------------------------------
      * @usuario_id
      * @hash
      * ambos parametros servem para 
      * verificação no banco de dados
      */
      function recuperarSenha($post)
      {
            if ($this->verificarEmail($post["email"])) {
                  $sql = 
                  "update usuario
                  set 
                  hash = :hash
                  where 
                  email = :email
                  limit 1
                  ";
                  $hash = md5(uniqid (rand (), true));
                  $consulta = $this->database->prepare($sql);      
                  $consulta->bindParam(':email', $post["email"], PDO::PARAM_STR);
                  $consulta->bindParam(':hash', $hash, PDO::PARAM_STR);
                  try{
                        $consulta->execute();
                        if($consulta->rowCount() > 0){
                              $email = new \Application\Model\Email;
                              return($email->recuperarSenha($post["email"], $hash));
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
            $this->flashMessages->adicionaMensagem(
                  "Este email não consta na nossa base de dados!", 
                  "2"
            );
            return false;
      }

      /*
      *------------------------------------
      * Função responsável alterar a senha
      * do usuário e destruir a hash
      *-----------------------------------
      * @usuario_id
      * @hash
      * ambos parametros servem para 
      * verificação no banco de dados
      */
      function trocarSenha($post)
      {
            $valida = true;
            if (
                  $post["password"] != $post["password_repeat"]
            ) {
                  $this->flashMessages->adicionaMensagem(
                        "As senhas inseridas devem ser identicas", 
                        "2"
                  );
                  $valida = false;
            }

            if (
                  empty($post["hash"])
            ) {
                  $valida = false;
                  $this->flashMessages->adicionaMensagem(
                        "Requisição inválida, 
                        efetue a requisição novamente", 
                        "2"
                  );
            }
            if (!$valida) {
                  return false;
            }
            $sql = 
            "update usuario
            set 
            senha = :senha,
            hash = '0'
            where 
            hash = :hash
            limit 1
            ";
            $hash = md5(uniqid (rand (), true));
            $consulta = $this->database->prepare($sql);      
            $encriptador = new \Application\Model\Encriptador;
            $senha = $encriptador->encriptar($post["password"]);
            $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
            $consulta->bindParam(':hash', $post["hash"], PDO::PARAM_STR);
            try{
                  $consulta->execute();
                  if($consulta->rowCount() > 0){                
                        return true;
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
            $this->flashMessages->adicionaMensagem(
                  "Este email não consta na nossa base de dados!", 
                  "2"
            );
            return false;
      }

      /*
      *------------------------------------
      * Função responsável por realizar
      * o login no sistema
      *-----------------------------------
      * @post formulário submetito
      * para 
      * verificação no banco de dados
      */
      function verificarLogin($post)
      {
            if (
                  empty($post["email"]) ||
                  $post["email"] == "" ||
                  empty($post["password"]) ||
                  $post["password"] == ""
            ){
            return false;
            }
            $sql = 
            "select 
                  usuario_id
            from 
            usuario
            where
            email = :email
            and
            senha = :senha
            and
            ativo = '1'
            limit 1
            ";
            $encriptador = new \Application\Model\Encriptador;
            $senha = $encriptador->encriptar($post["password"]);
            $consulta = $this->database->prepare($sql);      
            $consulta->bindParam(':email', $post["email"], PDO::PARAM_STR);
            $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
            try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                  $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
                  foreach($linha as $l){
                        return $l["usuario_id"];
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
      * Função responsável por contar
      * usuarios
      */
      function count()
      {
            $sql = 
            "SELECT
                  COUNT(usuario_id) as quantidade
            FROM usuario
            ";
            $consulta = $this->database->prepare($sql);      
            try{
                  $consulta->execute();
                  if($consulta->rowCount() > 0){            
                        $linha = $consulta->fetchAll(PDO::FETCH_ASSOC);
                        foreach($linha as $l){
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