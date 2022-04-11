<?php 
class BaseDao {
    protected $conn;
    protected $table;
    public function __construct($table){
        $this->table = $table;
        $servername = "localhost";
        $username = "newuser";
        $password = "admin";
        $database = "cinemaproject";
        $this->conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // set the PDO error mode to exception
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // get table
    public function getAllFromTable($pe){
        $stmt = $this->conn->prepare(`SELECT * FROM `.$this->table);
        $stmt->execute();
        return 
        $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // delete by id
    public function deleteByID($id) {
        $stmt = $this->conn->prepare(`DELETE FROM `.$this->table.` WHERE id = :id`);
        $stmt->execute(['id' => $id]);
        echo "Deleted";
    } 
    
    // add to table
    public function add($entity){
        $query = "INSERT INTO ".$this->table." (";
        foreach ($entity as $column => $value) {
          $query .= $column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
          $query .= ":".$column.", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
    
        $stmt= $this->conn->prepare($query);
        $stmt->execute($entity); // sql injection prevention
        $entity['id'] = $this->conn->lastInsertId();
        return $entity;
      }
    
    // update table
    public function update($id, $entity, $id_column = "id"){
        $query = "UPDATE ".$this->table_name." SET ";
        foreach($entity as $name => $value){
          $query .= $name ."= :". $name. ", ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${id_column} = :id";
    
        $stmt= $this->conn->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
    }

    // manual query
    protected function query($query, $params){
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


?>