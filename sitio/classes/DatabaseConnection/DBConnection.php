<?php
namespace Collector\DatabaseConnection;
use PDO;

class DBConnection {
    public const DB_HOST = '127.0.0.1';
    public const DB_USER = 'root';
    public const DB_PASS = '';
    public const DB_SCHEMA = 'dw3_neglia_mateo';

    public const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_SCHEMA . ';charset=utf8mb4';
    
    /** @var PDO **/
    protected PDO $db;

    public function __construct() {
        try {
            $this->db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);            
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(\Exception $e) {            
            echo 'Page under development, try again later.';
            exit;

        }
    }

    /** @return PDO **/
    public function getDB(): PDO {
        return $this->db;
    }

    /**
     * @param \Closure $function
     * @return void
     * @throws \Exception
     */
    public function runTransaction(\Closure $function) {
        $this->getDB()->beginTransaction();
        try {            
            $function();
            $this->getDB()->commit();
        } catch(\Exception $e) {
            $this->getDB()->rollBack();
            throw $e;
        }
    }
    
    public static function getConnection(): PDO {
        if(self::$db === null) {
            self::__construct();
        }

        return self::$db;
    }

    /**
     * @param string $query
     * @return \PDOStatement
     */
    public static function getStatement(string $query): \PDOStatement {
        return self::getConnection()->prepare($query);
    }

    /**
     * @param string $query
     * @param array|null $data
     * @return \PDOStatement
     */
    public static function executeQuery(string $query, ?array $data = null): \PDOStatement {
        $stmt = self::getStatement($query);
        $stmt->execute($data);
        return $stmt;
    }



}
