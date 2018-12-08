<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * do diario
 *-----------------------------------
*/
class Diario
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
    private $diario_id;
    private $date;
    private $presente;
    private $turma_id;
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
    * Função responsável pegar os diários
    * da turma
    *-----------------------------------   
    */
    function getDiarios($turma_id)
    {

        $turma = new \Application\Model\Turma;
        if (!$turma->verificaTurmaSession($turma_id)) {
            $this->flashMessages->adicionaMensagem("Erro de identificação!", "2");
            return false;
        }
        $sql = 
        "SELECT
            d.date as date,
            date_format(d.date, '%d/%m/%Y') as data,
            date_format(d.date, '%Y%m%d') as data_link,
            (SELECT
                COUNT(date)
            FROM 
                diario
            WHERE
                turma_id = :turma_id
            AND
                date = d.date
            AND
                presente = '0'
            ) as faltas,
            (SELECT
                COUNT(date)
            FROM 
                diario
            WHERE
                turma_id = :turma_id
            AND
                date = d.date
            AND
                presente = '1'
            ) as presencas
        FROM
            diario as d
        WHERE
            turma_id = :turma_id
        GROUP BY d.date
        ORDER BY d.date DESC
        ";
        $consulta = $this->database->prepare($sql);   
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
    * Função responsável inserir os diários
    * da turma
    *-----------------------------------   
    */
    function insertDiario($form, $diarios)
    {
        if (!$form["data"] = $this->verificaDataDB($form["data"])) {
            $this->flashMessages->adicionaMensagem("Data inválida!", "2");
            return false;
        }
        $commit = true;
        $this->database->beginTransaction();
        if ($this->getData($form["turma_id"], $form["data"])) {
            $this->flashMessages->adicionaMensagem(
                "Essa data já contem um registro!", 
                "2"
            );
            return false;
        }
        foreach ($diarios as $i) {
            $sql = 
            "INSERT INTO
                diario
            (
                date,
                presente,
                turma_id,
                aluno_id,
                vinculo_id
            )
            VALUES
            (
                :date,
                :presente,
                :turma_id,
                :aluno_id,
                :vinculo_id
            )
            ";
            $consulta = $this->database->prepare($sql); 
            $consulta->bindParam(':date', $form["data"], PDO::PARAM_STR);
            $consulta->bindParam(':presente', $i["presente"], PDO::PARAM_STR);
            $consulta->bindParam(':turma_id', $form["turma_id"], PDO::PARAM_INT);
            $consulta->bindParam(':aluno_id', $i["aluno_id"], PDO::PARAM_INT);
            $consulta->bindParam(':vinculo_id', $i["vinculo_id"], PDO::PARAM_INT);
            try{
                $consulta->execute();
                if($consulta->rowCount() > 0){
                    $commit = true;                    
                } else {
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
            $this->flashMessages->adicionaMensagem("Dados gravados", "1");
            return true;
        } else {
            $this->database->rollBack();
            $this->flashMessages->adicionaMensagem("Ocorreu um erro na operação", "2");
            return false;
        }
    }

    /*
    *------------------------------------
    * Verifica e converte data para db
    *-----------------------------------   
    */
    function verificaDataDB($data) {
        $arr_data = explode("/", $data);
        if (!empty($data)) {
            if (checkdate($arr_data[1], $arr_data[0], $arr_data[2])) {
                return $arr_data[2]."-".$arr_data[1]."-".$arr_data[0];
            }
            return false;
        } else {
            return false;
        }
    }


    /*
    *------------------------------------
    * Função responsável por pegar
    * alunos para editar presenca
    *-----------------------------------   
    */
    function getDiarioEditar($turma_id, $date)
    {

        $sql = 
        "select 
            al.aluno_id,
            concat_ws(' ', al.primeiro_nome, al.segundo_nome, al.ultimo_nome) as nome,
            date_format(al.datanascimento, '%d/%m/%Y') as datanascimento,
            vin.vinculo_id,
            d.date,
            d.turma_id,
            d.presente
        from 
            aluno as al
        left join vinculo as vin
            on vin.aluno_id = al.aluno_id
        left join diario as d
            on d.aluno_id = al.aluno_id
        where
            al.usuario_id = :usuario_id
        and
            d.date = :date
        and
            d.turma_id = :turma_id
        and
            vin.turma_id = :turma_id
        order by nome asc
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':date', $date, PDO::PARAM_STR);
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
    * Função responsável pegar data
    * formatada
    *-----------------------------------   
    */
    function getData($turma_id, $date)
    {
        $sql = 
        "select
        date_format(date, '%d/%m/%Y') as data
        from 
            diario
        where
            date = :date
        and 
            turma_id = :turma_id
        group by 
            date
        ";
        $consulta = $this->database->prepare($sql); 
        $consulta->bindParam(':date', $date, PDO::PARAM_STR);
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $l){
                    return $l["data"];
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
            $commit = false;
        }	
       
    }

    /*
    *------------------------------------
    * Função responsável pegar data
    * formatada
    *-----------------------------------   
    */
    function getDate($turma_id, $date)
    {
        $sql = 
        "select
            date
        from 
            diario
        where
            date = :date
        and 
            turma_id = :turma_id
        group by 
            date
        ";
        $consulta = $this->database->prepare($sql); 
        $consulta->bindParam(':date', $date, PDO::PARAM_STR);
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach($consulta->fetchAll(PDO::FETCH_ASSOC) as $l){
                return $l["date"];
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
            $commit = false;
        }	
       
    }


    /*
    *------------------------------------
    * Função responsável atualizar diario
    *-----------------------------------   
    */
    function updateDiario($form, $diarios)
    {
        $commit = true;
        $this->database->beginTransaction();
        foreach ($diarios as $i) {
            $sql = 
            "UPDATE 
                diario
            SET
                presente = :presente
            WHERE
                turma_id = :turma_id
            AND
                aluno_id = :aluno_id
            AND
                vinculo_id = :vinculo_id
            AND
                date = :data
            limit 1
            ";
            $consulta = $this->database->prepare($sql); 
            $consulta->bindParam(':presente', $i["presente"], PDO::PARAM_STR);
            $consulta->bindParam(':turma_id', $form["turma_id"], PDO::PARAM_INT);
            $consulta->bindParam(':aluno_id', $i["aluno_id"], PDO::PARAM_INT);
            $consulta->bindParam(':vinculo_id', $i["vinculo_id"], PDO::PARAM_INT);
            $consulta->bindParam(':data', $i["date"], PDO::PARAM_STR);
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
            $this->flashMessages->adicionaMensagem("Dados gravados", "1");
            return true;
        } else {
            $this->database->rollBack();
            $this->flashMessages->adicionaMensagem("Ocorreu um erro na operação", "2");
            return false;
        }
    }


    /*
    *------------------------------------
    * Função responsável atualizar diario
    *-----------------------------------   
    */
    function deleteDiario($form)
    {
        $sql = 
        "DELETE FROM
            diario
        WHERE
            turma_id = :turma_id
        and
            date = :date
        ";
        $consulta = $this->database->prepare($sql); 
        $consulta->bindParam(':turma_id', $form["turma_id"], PDO::PARAM_INT);
        $consulta->bindParam(':date', $form["date"], PDO::PARAM_STR);
        try{
            $consulta->execute();
            if ($consulta->rowCount() > 0) {
                return true;
            }            
            $this->flashMessages->adicionaMensagem("Não foi possível excluir!", "2");
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
    function getDiarioAluno($turma_id, $aluno_id)
    {

        $sql = 
        "SELECT
            (SELECT
                COUNT(date)
            FROM 
                diario
            WHERE
                turma_id = :turma_id
            AND
                aluno_id = :aluno_id
            AND
                presente = '0'
            ) as faltas,
            (SELECT
                COUNT(date)
            FROM 
                diario
            WHERE
                turma_id = :turma_id
            AND
                aluno_id = :aluno_id
            AND
                presente = '1'
            ) as presencas
        FROM
            diario as d
        WHERE
            turma_id = :turma_id
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
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
    * Função responsável pegar os diários
    * da turma
    *-----------------------------------   
    */
    function getDiarioAlunoTurma($turma_id, $aluno_id)
    {

        $sql = 
        "SELECT
            date_format(d.date, '%d/%m/%Y') as data,
            CASE
                WHEN presente = '1' THEN 'PRESENTE'
                WHEN presente = '0' THEN 'AUSENTE'
                ELSE ''	
            END as situacao
        FROM
            diario as d
        WHERE
            d.aluno_id = :aluno_id
        AND
            d.turma_id = :turma_id
        ORDER BY d.date DESC;
        ";
        $consulta = $this->database->prepare($sql);   
        $consulta->bindParam(':turma_id', $turma_id, PDO::PARAM_INT);
        $consulta->bindParam(':aluno_id', $aluno_id, PDO::PARAM_INT);
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