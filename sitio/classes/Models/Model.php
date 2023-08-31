<?php

namespace Collector\Models;
use Collector\DatabaseConnection\DBConnection;
use PDO;

class Model {
    /** @var string */
    protected string $table = "";
    /** @var string */
    protected string $primaryKey = "";
    /** @var array|string[] */
    protected array $properties = [];

    /**          
     * @param array $data
     * @return void
     */
    public function loadProperties(array $data): void {        
        foreach($data as $key => $value) {
            if(in_array($key, $this->properties)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return array|static[]
     */
    public function getAll(): array {
        $db = (new DBConnection())->getDB();
        $query = "SELECT * FROM {$this->table}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }

    /**          
     * @param int $id
     * @return $this|null
     */    
    public function getById(int $id): ?static {
        $db = (new DBConnection())->getDB();
        $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);    
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);            
            
        $obj = $stmt->fetch();        
        return $obj ? $obj : null;
    }
}

