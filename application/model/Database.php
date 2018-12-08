<?php

namespace Application\Model;
use \PDO;

/*
 * --------------------------------------------------------------------
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton. 
 * --------------------------------------------------------------------
 * Modo de Usar:
 * $db = Database::conectar();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $db.
 */

class Database
{
    # Variável que guarda a conexão PDO.
    protected static $db;
    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
        $db_host = "localhost";
        $db_nome = "systeacher";
        $db_usuario = "root";
        $db_senha= "";
        //$db_nome = "id6824472_systeacher";
        //$db_usuario = "id6824472_root";
        //$db_senha = "systeacher2018";
        $db_driver = "mysql";
        $sistema_titulo = "systeacher";
        try {
            # Atribui o objeto PDO à variável $db.
            self::$db = new \PDO("$db_driver:host=$db_host; dbname=$db_nome", $db_usuario, $db_senha);
            # Garante que o PDO lance exceções durante erros.
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$db->exec('SET NAMES utf8');         
        } catch (PDOException $e) {
            echo ($e->getMessage());
            die("Connection Error: " . $e->getMessage());
        }
    }
    # Método estático - acessível sem instanciação.
    public static function conectar()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$db)
        {
            //echo"conectado";
            new Database();
        }
        
        # Retorna a conexão.
        return self::$db;
    }
}
?>