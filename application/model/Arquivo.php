<?php

namespace Application\Model;
use \Application\Model;
use \PDO;

/*
 *------------------------------------
 * Classe responsável pela manipulação
 * de arquivo
 *-----------------------------------
*/
class Arquivo
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
    private $arquivo_id;
    private $descricao;
    private $tipo;
    private $tamanho;
    private $nome_arquivo;
    private $criacao;
    private $categoria_id;
    private $usuario_id;

    public function __construct()
    {
        $this->database = \Application\Model\Database::conectar();
        $this->flashMessages = new \Application\Model\FlashMessages;
        $this->session = new \Application\Model\Session;
        if (!file_exists("repository/bancodearquivos")) {
            mkdir("repository/bancodearquivos", 0777);
        }
        $this->source = 'repository/bancodearquivos/';
    }

    /*
    *------------------------------------
    * Função responsável por validar e 
    * registrar um arquivo
    *-----------------------------------
    * @post form
    */
    public function insertArquivo($post = null, $files = null) 
    {
        $this->database->beginTransaction();
        $valida = true;
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
        if (strlen($post["descricao"]) > 200) {
            $valida = false;
            $this->flashMessages->adicionaMensagem(
                "Tamanho máximo da descrição é 200 caracteres", 
                "2"
            );
        }
        if (!$valida) {
            return false;
        }
        if ($files != null) {
            $arr_upload = $this->insertBancoDeArquivo($files);
        }
        if ($arr_upload == null) {
            $this->flashMessages->adicionaMensagem(
                "Falha ao realizar o upload!", 
                "2"
            );
            return false;
        }
    
        $sql = 
        "insert into arquivo
        (descricao,
        caminho,
        tipo,
        tamanho,
        nome_arquivo,
        criacao,
        categoria_id,
        usuario_id)
        values
        (:descricao, 
        :caminho,
        :tipo,
        :tamanho,
        :nome_arquivo,
        :criacao,
        :categoria_id,
        :usuario_id)
        ";
        $consulta = $this->database->prepare($sql);      
        $consulta->bindParam(':descricao', $post["descricao"], PDO::PARAM_STR);
        $consulta->bindParam(':caminho', $arr_upload["filemoved"], PDO::PARAM_STR);
        $consulta->bindParam(':tipo', $arr_upload["filetype"], PDO::PARAM_STR);
        $consulta->bindParam(':tamanho', $arr_upload["filesize"], PDO::PARAM_STR);
        $consulta->bindParam(':nome_arquivo', $arr_upload["filename"], PDO::PARAM_STR);
        $data = date("Y-m-d H:i:s");
        $consulta->bindParam(':criacao', $data, PDO::PARAM_STR);        
        if (
            $post["categoria_id"] == null ||
            $post["categoria_id"] == ""
        ) {
            $consulta->bindParam(':categoria_id', $post["categoria_id"], PDO::PARAM_NULL);    
        } else {
            $consulta->bindParam(':categoria_id', $post["categoria_id"], PDO::PARAM_INT);
        }
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){       
                    $this->flashMessages->adicionaMensagem(
                    "Arquivo cadastrado!", 
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
    * arquivos e tratar filtros
    *-----------------------------------   
    */
    function getArquivos($categoria = null)
    {
        $sql = 
        "select 
            arq.arquivo_id as arquivo_id,
            arq.descricao as descricao,
            date_format(arq.criacao, '%d/%m/%Y') as criacao,
            case 
                WHEN cat.descricao is not null THEN cat.descricao
                ELSE 'Sem categoria'
            end as categoria
        from 
            arquivo as arq
        left join categoria as cat
            on cat.categoria_id = arq.categoria_id
        where
            arq.usuario_id = :usuario_id
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
    * todas arquivo pelo id
    *-----------------------------------   
    */
    function getArquivoById($arquivo_id)
    {
        $sql = 
        "select 
        *
        from 
            arquivo
        where
            usuario_id = :usuario_id
        and
            arquivo_id = :arquivo_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':arquivo_id', $arquivo_id, PDO::PARAM_INT);
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
    * dar update em um arquivo
    *-----------------------------------
    * @post form
    */
    public function updateArquivo($post = null, $files = null) 
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["arquivo_id"]) ||
            $post["arquivo_id"] == ""
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
                "O campo descrição é obrigatório!", 
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
        if (!$valida) {
            return false;
        }
        $arr_upload = $this->insertBancoDeArquivo($files);
    
        $sql = 
        "update arquivo set
            descricao = :descricao,";
        if ($arr_upload) {
            $sql .= "
                caminho = :caminho,
                tipo = :tipo,
                tamanho = :tamanho,
                nome_arquivo = :nome_arquivo, 
            ";
        }            
        $sql .= "
            categoria_id = :categoria_id
        where
            usuario_id = :usuario_id
        and
            arquivo_id = :arquivo_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql);      
        $consulta->bindParam(':descricao', $post["descricao"], PDO::PARAM_STR);
        if ($arr_upload) {
            $consulta->bindParam(':caminho', $arr_upload["filemoved"], PDO::PARAM_STR);
            $consulta->bindParam(':tipo', $arr_upload["filetype"], PDO::PARAM_STR);
            $consulta->bindParam(':tamanho', $arr_upload["filesize"], PDO::PARAM_STR);
            $consulta->bindParam(':nome_arquivo', $arr_upload["filename"], PDO::PARAM_STR);
        }
        if (
            $post["categoria_id"] == null ||
            $post["categoria_id"] == ""
        ) {
            $consulta->bindParam(':categoria_id', $post["categoria_id"], PDO::PARAM_NULL);    
        } else {
            $consulta->bindParam(':categoria_id', $post["categoria_id"], PDO::PARAM_INT);
        }
        $usuario_id = $this->session->getSession();
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':arquivo_id', $post["arquivo_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            $this->flashMessages->adicionaMensagem(
                "Arquivo editado!", 
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
    * excluir um arquivo
    *-----------------------------------   
    */
    function deleteArquivo($post)
    {
        $this->database->beginTransaction();
        $valida = true;
        if (
            empty($post["arquivo_id"]) ||
            $post["arquivo_id"] == ""
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
            arquivo
        where
            usuario_id = :usuario_id
        and
            arquivo_id = :arquivo_id
        limit 1
        ";
        $consulta = $this->database->prepare($sql); 
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $consulta->bindParam(':arquivo_id', $post["arquivo_id"], PDO::PARAM_INT);
        try{
            $consulta->execute();
            $this->database->commit();
            $this->flashMessages->adicionaMensagem(
                "Registro excluído", 
                "1"
            );
            $this->deleteBancoDeQuestao($post["caminho"]);
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
    * Função responsável pelo upload
    * do arquivo do banco de arquivos
    *-----------------------------------
    * @files
    */
    public function insertBancoDeArquivo($files = null) 
    {
        if (
            $files == null
        ) {
            return null;
        }
        $_FILES = $files;
        if (
            $_FILES["file"]["tmp_name"] == null ||
            $_FILES["file"]["tmp_name"] == ""
        ) {
            return null;
        }
        $arr_upload = array(  
            "filemoved" => date("YmdHis").md5($_FILES["file"]["tmp_name"]),   
            "filetype" => $_FILES["file"]["type"],
            "filesize" => $_FILES["file"]["size"],
            "filename" => $_FILES["file"]["name"],
            "fileerros" => $_FILES["file"]["error"]
        );
        move_uploaded_file(
            $_FILES['file']['tmp_name'], 
            $this->source.date("YmdHis").md5($_FILES["file"]["tmp_name"])
        );
        return $arr_upload;
    }

    /*
    *------------------------------------
    * Função responsável por gerar
    * o link para download do arquivo
    *-----------------------------------
    * @files
    */
    public function getBancoDeQuestao($arquivo_id) 
    {
        return "arquivo_download/$arquivo_id/".md5($this->session->getSession());
    }

    /*
    *------------------------------------
    * Função responsável deletar um arquivo
    *-----------------------------------
    * @files
    */
    public function deleteBancoDeQuestao($caminho) 
    {
        $file = "repository/bancodequestao/".$caminho;
        if (file_exists($file)) {
            unlink($caminho);
            return true;
        }
        return false;
    }


    /*
    *------------------------------------
    * Função responsável por contar
    * os arquivos
    *-----------------------------------   
    */
    function count()
    {
        $sql = 
        "SELECT
            COUNT(arquivo_id) as quantidade
        FROM
            arquivo 
        ";
        $consulta = $this->database->prepare($sql);   
        $usuario_id = $this->session->getSession();   
        $consulta->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
        try{
            $consulta->execute();
            if($consulta->rowCount() > 0){
                foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $l){
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