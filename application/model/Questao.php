<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * das questões
 *-----------------------------------
*/
class Questao
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
    private $questao_id;
    private $descricao;
    private $tipo;
    private $criacao;
    private $conteudo_id;
    private $usuario_id;
    private $disciplina_id;
    private $ciencia_id;

    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
    }

    /*
    *------------------------------------
    * Função responsável pegar as questoes
    *-----------------------------------   
    */
    function getQuestao()
    {

        $sql = 
        "
        select
            q.questao_id,
            q.descricao,
            CASE
                WHEN tipo = '2' then 'Objetiva'
                WHEN tipo = '1' then 'Descritiva'
            END as tipo_texto,
            q.tipo,
            date_format(q.criacao, '%d/%d/%Y') as criacao,
            q.conteudo_id,
            q.usuario_id,
            q.disciplina_id,
            q.ciencia_id
        from
            questao as q
        where
            q.usuario_id = :usuario_id
        order by q.criacao desc
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
    * Função responsável pegar as questoes
    * do feed
    *-----------------------------------   
    */
    function getQuestaoFeed()
    {

        $sql = 
        "
        select
            q.questao_id,
            q.descricao,
            CASE
                WHEN tipo = '2' then 'Objetiva'
                WHEN tipo = '1' then 'Descritiva'
            END as tipo_texto,
            q.tipo,
            date_format(q.criacao, '%d/%d/%Y') as criacao,
            q.conteudo_id,
            q.usuario_id,
            q.disciplina_id,
            q.ciencia_id
        from
            questao as q
        order by q.criacao desc
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
    * Função responsável pegar as questoes
    *-----------------------------------   
    */
    function getQuestaoById($questao_id)
    {

        $sql = 
        "
        select
            *
        from
            questao as q
        where
            q.usuario_id = :usuario_id
        and
            q.questao_id = :questao_id
        order by q.criacao desc
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $l) {
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
    * Função responsável dados para impressão
    *-----------------------------------   
    */
    function getQuestaoPrint($questao_id)
    {

        $sql = 
        "
        select
            q.*,
            case
                when q.tipo = '1' then 'Descritiva'
                when q.tipo = '2' then 'Objetiva'
            end as tipo_texto,
            c.descricao as ciencia,
            d.descricao as disciplina,
            con.descricao as conteudo
        from
            questao as q
        inner join  ciencia as c
            on c.ciencia_id = q.ciencia_id
        inner join disciplina as d
            on d.disciplina_id = q.disciplina_id
        inner join conteudo as con
            on con.conteudo_id = c.ciencia_id
        where
            q.questao_id = :questao_id
        order by q.criacao desc
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $l) {
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
    * Função responsável dados para impressão
    *-----------------------------------   
    */
    function getQuestaoVisualizar($questao_id)
    {

        $sql = 
        "
        select
            q.*,
            case
                when q.tipo = '1' then 'Descritiva'
                when q.tipo = '2' then 'Objetiva'
            end as tipo_texto,
            c.descricao as ciencia,
            d.descricao as disciplina,
            con.descricao as conteudo
        from
            questao as q
        inner join  ciencia as c
            on c.ciencia_id = q.ciencia_id
        inner join disciplina as d
            on d.disciplina_id = q.disciplina_id
        inner join conteudo as con
            on con.conteudo_id = c.ciencia_id
        where
            q.questao_id = :questao_id
        order by q.criacao desc
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $l) {
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
    * Função responsável pegar as questoes
    * por filtro
    *-----------------------------------   
    */
    function getQuestaoFiltro($filtro)
    {

        $sql = 
        "
        select
            q.questao_id,
            q.descricao,
            CASE
                WHEN tipo = '2' then 'Objetiva'
                WHEN tipo = '1' then 'Descritiva'
            END as tipo_texto,
            q.tipo,
            date_format(q.criacao, '%d/%d/%Y') as criacaoa,
            q.conteudo_id,
            q.usuario_id,
            q.disciplina_id,
            q.ciencia_id
        from
            questao as q
        where
            q.usuario_id = :usuario_id
        ";
        if (
            $filtro["ciencia"] != ""
        ) {
            $sql.=" and ciencia_id = :ciencia_id";
        }
        if (
            $filtro["disciplina"] != ""
        ) {
            $sql.=" and disciplina_id = :disciplina_id";
        }
        if (
            $filtro["conteudo"] != ""
        ) {
            $sql.=" and conteudo_id = :conteudo_id";
        }
        $sql .="
        order by q.criacao desc
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        if (
            $filtro["ciencia"] != ""
        ) {
            $consulta->bindParam(':ciencia_id', $filtro["ciencia"], PDO::PARAM_INT);
        }
        if (
            $filtro["disciplina"] != ""
        ) {
            $consulta->bindParam(':disciplina_id', $filtro["disciplina"], PDO::PARAM_INT);
        }
        if (
            $filtro["conteudo"] != ""
        ) {
            $consulta->bindParam(':conteudo_id', $filtro["conteudo"], PDO::PARAM_INT);
        }
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
    * Função responsável pegar as questoes
    * por filtro fedd
    *-----------------------------------   
    */
    function getQuestaoFiltroFeed($filtro)
    {

        $sql = 
        "
        select
            q.questao_id,
            q.descricao,
            CASE
                WHEN tipo = '2' then 'Objetiva'
                WHEN tipo = '1' then 'Descritiva'
            END as tipo_texto,
            q.tipo,
            date_format(q.criacao, '%d/%d/%Y') as criacaoa,
            q.conteudo_id,
            q.usuario_id,
            q.disciplina_id,
            q.ciencia_id
        from
            questao as q
        where
            q.usuario_id > 0
        ";
        if (
            $filtro["ciencia"] != ""
        ) {
            $sql.=" and ciencia_id = :ciencia_id";
        }
        if (
            $filtro["disciplina"] != ""
        ) {
            $sql.=" and disciplina_id = :disciplina_id";
        }
        if (
            $filtro["conteudo"] != ""
        ) {
            $sql.=" and conteudo_id = :conteudo_id";
        }
        $sql .="
        order by q.criacao desc
        ";
        $consulta = $this->database->prepare($sql);   
        if (
            $filtro["ciencia"] != ""
        ) {
            $consulta->bindParam(':ciencia_id', $filtro["ciencia"], PDO::PARAM_INT);
        }
        if (
            $filtro["disciplina"] != ""
        ) {
            $consulta->bindParam(':disciplina_id', $filtro["disciplina"], PDO::PARAM_INT);
        }
        if (
            $filtro["conteudo"] != ""
        ) {
            $consulta->bindParam(':conteudo_id', $filtro["conteudo"], PDO::PARAM_INT);
        }
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
    * Função responsável pegar os diários
    * da turma
    *-----------------------------------   
    */
    function getQuestaoResposta($questao_id, $tipo)
    {
        if ($tipo == "2") {
            $sql = 
            "
            select
                *
            from
                resposta_objetiva as ro
            WHERE
                ro.questao_id = :questao_id
            ";
        } elseif ($tipo == "1") {
            $sql = 
            "
            select
                *
            from
                resposta_descritiva as ro
            WHERE
                ro.questao_id = :questao_id
            ";
        }  
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
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
    * Função responsável por inserir questao
    *-----------------------------------   
    */
    function insertDescritiva($questao, $descritiva)
    {
        $commit = true;
        $this->database->beginTransaction();
        $sql = 
        "INSERT INTO
            questao
        (
            descricao, 
            tipo,  
            usuario_id, 
            conteudo_id, 
            disciplina_id, 
            ciencia_id
        )
        VALUES
        (
            :descricao,
            :tipo,
            :usuario_id,
            :conteudo_id,
            :disciplina_id,
            :ciencia_id
        )
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':descricao', $questao["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':tipo', $questao["tipo"], PDO::PARAM_INT);
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':conteudo_id', $questao["conteudo"], PDO::PARAM_INT);
        $consulta->bindParam(':disciplina_id', $questao["disciplina"], PDO::PARAM_INT);
        $consulta->bindParam(':ciencia_id', $questao["ciencia"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() != 1){
                $commit = false;
            }
            $questao_id = $this->database->lastInsertId();
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $commit = false;
        }	        
        $sql = 
        "INSERT INTO
            resposta_descritiva
        (
            resposta, 
            questao_id            
        )
        VALUES
        (
            :resposta,
            :questao_id
        )
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':resposta', $descritiva["resposta"], PDO::PARAM_STR);
        $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() != 1){
                $commit = false;
            }
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $commit = false;
        }	
        if ($commit) {
            $this->database->commit();
            $this->flashMessages->adicionaMensagem(
                "Questão cadastrada!",
                "1"
            );
            return true;
        } else {
            $this->database->rollBack(); $this->flashMessages->adicionaMensagem(
                "Erro ao cadastrar questão!",
                "2"
            );
            return false;
        }
    }


    /*
    *------------------------------------
    * Função responsável por atualizar questao
    *-----------------------------------   
    */
    function updateDescritiva($questao, $descritiva, $descritiva_id)
    {
        $commit = true;
        $this->database->beginTransaction();
        $sql = 
        "UPDATE
            questao
        set
            descricao = :descricao
        where
            usuario_id = :usuario_id
        and
            questao_id = :questao_id
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':descricao', $questao["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':questao_id', $questao["questao_id"], PDO::PARAM_INT);
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $commit = false;
        }	        
        $sql = 
        "UPDATE
            resposta_descritiva
        set
            resposta = :resposta
        where
            resposta_descritiva_id = :resposta_descritiva_id
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':resposta', $descritiva[0], PDO::PARAM_STR);
        $consulta->bindParam(':resposta_descritiva_id', $descritiva_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $commit = false;
        }	
        if ($commit) {
            $this->database->commit();
            $this->flashMessages->adicionaMensagem(
                "Questão atualizada!",
                "1"
            );
            return true;
        } else {
            $this->database->rollBack(); $this->flashMessages->adicionaMensagem(
                "Erro ao atualizar questão!",
                "2"
            );
            return false;
        }
    }


    /*
    *------------------------------------
    * Função responsável por inserir questao
    *-----------------------------------   
    */
    function insertObjetiva($questao, $objetiva, $correta)
    {
        $commit = true;
        $this->database->beginTransaction();
        $sql = 
        "INSERT INTO
            questao
        (
            descricao, 
            tipo,  
            usuario_id, 
            conteudo_id, 
            disciplina_id, 
            ciencia_id
        )
        VALUES
        (
            :descricao,
            :tipo,
            :usuario_id,
            :conteudo_id,
            :disciplina_id,
            :ciencia_id
        )
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':descricao', $questao["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':tipo', $questao["tipo"], PDO::PARAM_INT);
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':conteudo_id', $questao["conteudo"], PDO::PARAM_INT);
        $consulta->bindParam(':disciplina_id', $questao["disciplina"], PDO::PARAM_INT);
        $consulta->bindParam(':ciencia_id', $questao["ciencia"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() != 1){
                $commit = false;
            }
            $questao_id = $this->database->lastInsertId();
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $commit = false;
        }	   
        foreach ($objetiva as $key => $value) {
            $sql = 
            "INSERT INTO
                resposta_objetiva
            (
                resposta, 
                correta,
                questao_id            
            )
            VALUES
            (
                :resposta,
                :correta,
                :questao_id
            )
            ";
            $consulta = $this->database->prepare($sql);   
            $usuario_id = $this->session->getSession();
            $consulta->bindParam(':resposta', $value, PDO::PARAM_STR);
            if ($key == $correta) {
                $vlr_correto = "1";
            } else {
                $vlr_correto = "0";
            }
            $consulta->bindParam(':correta', $vlr_correto, PDO::PARAM_STR);
            $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
            try{
                $consulta->execute();
                if($consulta->rowCount() != 1){
                    $commit = false;
                }
            }catch(PDOException $e){
                if (ENVIRONMENT == "development") {
                    $this->flashMessages->adicionaMensagem(
                    $e->getMessage(), 
                    "2"
                    );
                }
                $commit = false;
            }	
        
        }
        if ($commit) {
            $this->database->commit();
            $this->flashMessages->adicionaMensagem(
                "Questão cadastrada!",
                "1"
            );
            return true;
        } else {
            $this->database->rollBack();
            $this->flashMessages->adicionaMensagem(
                "Erro ao cadastrar questão!",
                "2"
            );
            return false;
        }
    }

    /*
    *------------------------------------
    * Função responsável por atualizar questao
    *-----------------------------------   
    */
    function updateObjetiva($questao, $objetiva)
    {
        $commit = true;
        $this->database->beginTransaction();
        $sql = 
        "UPDATE
            questao
        SET
            descricao = :descricao
        WHERE
            usuario_id = :usuario_id
        AND
            questao_id = :questao_id
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':descricao', $questao["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':questao_id', $questao["questao_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
        }catch(PDOException $e){
            if (ENVIRONMENT == "development") {
                $this->flashMessages->adicionaMensagem(
                $e->getMessage(), 
                "2"
                );
            }
            $commit = false;
        }	   
        foreach ($objetiva as $resposta) {
            $sql = 
            "UPDATE
                resposta_objetiva
            SET
                resposta = :resposta
            WHERE 
                resposta_objetiva_id = :resposta_objetiva_id
            ";
            $consulta = $this->database->prepare($sql);   
            $consulta->bindParam(':resposta', $resposta["resposta"], PDO::PARAM_STR);
            $consulta->bindParam(':resposta_objetiva_id', $resposta["resposta_objetiva_id"], PDO::PARAM_INT);
            try{
                $consulta->execute();
            }catch(PDOException $e){
                if (ENVIRONMENT == "development") {
                    $this->flashMessages->adicionaMensagem(
                    $e->getMessage(), 
                    "2"
                    );
                }
                $commit = false;
            }	
        
        }
        if ($commit) {
            $this->database->commit();
            $this->flashMessages->adicionaMensagem(
                "Questão atualizada!",
                "1"
            );
            return true;
        } else {
            $this->database->rollBack();
            $this->flashMessages->adicionaMensagem(
                "Erro ao atualizar questão!",
                "2"
            );
            return false;
        }
    }


    /*
    *------------------------------------
    * Função responsável por deletar
    *-----------------------------------   
    */
    function deleteQuestao($questao_id)
    {

        $sql = 
        "
        delete from questao
        where
            usuario_id = :usuario_id
        and
        questao_id = :questao_id
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':questao_id', $questao_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                $this->flashMessages->adicionaMensagem(
                    "Questão excluída",
                    "1"
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
    * Função responsável por contar questões
    *-----------------------------------   
    */
    function count()
    {

        $sql = 
        "SELECT
            COUNT(questao_id) as quantidade
        FROM
            questao 
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