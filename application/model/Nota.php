<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * da nota
 *-----------------------------------
*/
class Nota
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
    private $nota_id;
    private $valor;
    private $avaliacao_id;
    private $aluno_id;
    private $vinculo_id;


    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }

    /*
    *------------------------------------
    * Função responsável por atualizar
    * notas
    *-----------------------------------   
    */
    function updateNota($arr_dados)
    {
        $commit = true;
        $this->database->beginTransaction();
        foreach ($arr_dados as $dados) {
            $valida_valor = true;
            if (
                !is_numeric($dados["valor"]) ||
                $dados["valor"] < 0 ||
                $dados["valor"] > 100
            ){
                $valida_valor = false;
            }
            if ($valida_valor) {
                $sql = 
                "UPDATE
                    nota
                SET
                    valor = :valor
                WHERE
                    nota_id = :nota_id
                AND
                    avaliacao_id = :avaliacao_id
                AND
                    aluno_id = :aluno_id
                LIMIT 1
                ";
                $consulta = $this->database->prepare($sql);     
                $consulta->bindParam(':valor', $dados["valor"], PDO::PARAM_INT);
                $consulta->bindParam(':nota_id', $dados["nota_id"], PDO::PARAM_INT);
                $consulta->bindParam(':avaliacao_id', $dados["avaliacao_id"], PDO::PARAM_INT);
                $consulta->bindParam(':aluno_id', $dados["aluno_id"], PDO::PARAM_INT);
                try{
                    $consulta->execute();
                    $commit = true;    
                }catch(PDOException $e){
                    if (ENVIRONMENT == "development") {
                        $this->flashMessages->adicionaMensagem(
                        $e->getMessage(), 
                        "2"
                        );
                    }
                    $commit = false;
                }	
            } else {
                $commit = false;
                $this->flashMessages->adicionaMensagem(
                    "Você inseriu um valor de nota inválido, insira um valor de 0 a 100", "2"
                );
            }
            
        }

        if ($commit) {
            $this->database->commit();
            return true;
        } else {
            $this->flashMessages->adicionaMensagem(
                "Ocorreu um erro na operação", "2"
            );
            $this->database->rollBack();
            return false;
        }
        
    }


    /*
    *------------------------------------
    * Função responsável por atualizar
    * notas
    *-----------------------------------   
    */
    function getMedia($aluno_id, $turma_id, $quantidade)
    {
        $sql = 
        "SELECT
            ROUND(SUM(valor)/:quantidade, 2) as media
        FROM
            nota as n
        inner join avaliacao as av ON
            av.avaliacao_id = n.avaliacao_id
        WHERE
            n.aluno_id = :aluno_id
        AND
            av.turma_id = :turma_id
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $l) {
                    return $l["media"];
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
    * Função responsável por atualizar
    * notas
    *-----------------------------------   
    */
    function getNotasAluno($aluno_id, $turma_id)
    {
        $sql = 
        "select
            *
        from
            nota as n
        inner join avaliacao as av
            on av.avaliacao_id = n.avaliacao_id
        where
            n.aluno_id = :aluno_id
        and
            av.turma_id = :turma_id
        order by numero
        ";
        $consulta = $this->database->prepare($sql);     
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
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
        }	
    }

}