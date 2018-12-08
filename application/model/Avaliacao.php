<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * da avaliação
 *-----------------------------------
*/
class Avaliacao
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
    private $avaliacao_id;
    private $descricao;
    private $numero;
    private $turma_id;


    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }

    /*
    *------------------------------------
    * Função responsável verificar se 
    * existe avaliação, se não existe
    * chama função para criar
    *-----------------------------------   
    */
    function verificaAvaliacao($turma_id, $numero)
    {
        $sql = 
        "select
            *
        from
            avaliacao
        where
            turma_id = :turma_id
        and
            numero = :numero
        limit 1
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':numero', $numero, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $l){
                    return $l;
                }
            } else {
                if ($this->insertAvaliacao($turma_id, $numero)) {
                    return $this->verificaAvaliacao($turma_id, $numero);
                }
            }            
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
    * Função responsável inserir
    * avaliação
    *-----------------------------------   
    */
    function insertAvaliacao($turma_id, $numero)
    {
        $sql = 
        "insert into
            avaliacao
        (
            descricao,
            numero,
            turma_id
        )
        values
        (
            '',
            :numero,
            :turma_id
        )
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':numero', $numero, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
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
            return false;
        }	
    }


    /*
    *------------------------------------
    * Função responsável verificar se 
    * existe avaliação, se não existe
    * chama função para criar
    *-----------------------------------   
    */
    function verificaSessao($turma_id, $avaliacao_id)
    {
        $sql = 
        "select
            *
        from
            turma as t
        inner join avaliacao as a
            on t.turma_id = a.turma_id
        where 
            a.avaliacao_id = :avaliacao_id
        and
            t.turma_id = :turma_id
        and
            t.usuario_id = :usuario_id
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':avaliacao_id', $avaliacao_id, PDO::PARAM_INT);
        $usuario_id = $this->session->getSession();   
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
    * Função responsável atualizar 
    * avaliação
    *-----------------------------------   
    */
    function updateAvaliacao($avaliacao)
    {
        $oper = true;
        if (
            !$this->verificaSessao(
                $avaliacao["turma_id"], 
                $avaliacao["avaliacao_id"]
            )
        ){
            $this->flashMessages("Ocorreu um erro ao atualizar a turma!", "2");
            $oper = false;
        }
        if (
            strlen($avaliacao["descricao"]) > 150
        ){
            $this->flashMessages("O campo descrição não pode ser maior que 150 caracteres!", "2");
            $oper = false;
        }
        if (!$oper) {
            return false;
        }
        $sql = 
        "update
            avaliacao
        set
            descricao = :descricao
        where
            turma_id = :turma_id
        and
            avaliacao_id = :avaliacao_id
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':descricao', $avaliacao["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':turma_id', $avaliacao["turma_id"], PDO::PARAM_INT);
        $consulta->bindParam(':avaliacao_id', $avaliacao["avaliacao_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
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


    /*
    *------------------------------------
    * Função responsável verificar se 
    * existe nota, chama
    * inicializadores para o array de alunos
    *-----------------------------------   
    */
    function verificaNota($arr_alunos, $avaliacao_id) {
        $commit = true;
        $this->database->beginTransaction();
        foreach ($arr_alunos as $alunos) {
            if (!$this->verificaNotaExiste($alunos, $avaliacao_id)) {
                $commit = false;
            }
        }
        if ($commit) {
            $this->database->commit();
        } else {
            $this->flashMessages->adicionaMensagem("Erro ao inicializar notas", "2");
            $this->database->rollBack();
        }
    }

    /*
    *------------------------------------
    * Função responsável verificar se 
    * existe nota, se não existe
    * chama função para criar
    *-----------------------------------   
    */
    function verificaNotaExiste($aluno, $avaliacao_id)
    {
        $sql = 
        "select
            *
        from
            nota
        where
            aluno_id = :aluno_id
        and
            avaliacao_id = :avaliacao_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':aluno_id', $aluno["aluno_id"], PDO::PARAM_INT);
        $consulta->bindParam(':avaliacao_id', $avaliacao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $l){
                    return $l;
                }
            } else {
                if ($this->insertNotaExiste($aluno, $avaliacao_id)) {
                    return $this->verificaNotaExiste($aluno, $avaliacao_id);
                }
            }            
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
    * Função responsável inserir
    * nota vindo da função 
    * verificaNotaExiste
    *-----------------------------------   
    */
    function insertNotaExiste($aluno, $avaliacao_id)
    {
        $sql = 
        "insert into
            nota
        (
            valor,
            avaliacao_id,
            aluno_id,
            vinculo_id
        )
        values
        (
            '0',
            :avaliacao_id,
            :aluno_id,
            :vinculo_id
        )
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':avaliacao_id', $avaliacao_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $aluno["aluno_id"], PDO::PARAM_INT);
        $consulta->bindParam(':vinculo_id', $aluno["vinculo_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
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
            return false;
        }	
    }

    /*
    *------------------------------------
    * Pega notas das avaliações da turma
    *-----------------------------------   
    */
    function getAvaliacaoByTurmaId($turma_id)
    {
        $sql = 
        "select 
            *
        from
            avaliacao
        where
            turma_id = :turma_id
        ";
        $consulta = $this->database->prepare($sql);             
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return ($consulta->fetchAll(PDO::FETCH_ASSOC));
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
    * Pega notas das avaliações da turma
    *-----------------------------------   
    */
    function getNotasAvaliacaoId($avaliacao_id)
    {
        $sql = 
        "select 
            n.nota_id,
            n.valor,
            n.avaliacao_id,
            n.aluno_id,
            concat_ws(' ', a.primeiro_nome, a.segundo_nome, a.ultimo_nome) as nome
        from
            nota as n
        inner join aluno as a
            on a.aluno_id = n.aluno_id
        where
            n.avaliacao_id = :avaliacao_id
        ";
        $consulta = $this->database->prepare($sql);             
        $consulta->bindParam(':avaliacao_id', $avaliacao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                return ($consulta->fetchAll(PDO::FETCH_ASSOC));
            } else {
                if ($this->insertNotaExiste($aluno_id, $avaliacao_id)) {
                    return $this->verificaNotaExiste($aluno_id, $avaliacao_id);
                }
            }            
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