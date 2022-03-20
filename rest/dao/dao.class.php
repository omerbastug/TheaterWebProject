<?php

class MoviesDao {

  private $conn;

  public function __construct(){

      $servername = "localhost";
      $username = "newuser";
      $password = "admin";
      $schema = "lecture1";

      $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }

  /**
  * Method used to read all todo objects from database
  */
  public function get_all(){
    $stmt = $this->conn->prepare("SELECT * FROM movielist");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**x`
  * Method used to add todo to the database
  */
  public function add($movie, $published){
    $stmt = $this->conn->prepare("INSERT INTO movielist (movieName, datePublished) VALUES ( :movie , :published )");
    $stmt->execute(['movie' => $movie, 'published' => $published]); // Same as bindParam() / Injection prevention
  }

  public function addMovie($movie){
    $stmt = $this->conn->prepare("INSERT INTO movielist (movieName, datePublished) VALUES ( :movie , :published )");
    $stmt->execute();
  } 
  /**
  * Delete todo record from the database
  */
  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM movielist WHERE id=:id");
    $stmt->bindParam(':id', $id); // SQL injection prevention
    $stmt->execute();
  }

  /**
  * Update todo record
  */
  public function update($id, $descriptionn, $created){
    $stmt = $this->conn->prepare("UPDATE movielist SET movieName=:descriptionn, datePublished=:created WHERE id=:id");
    $stmt->execute(['id' => $id, 'descriptionn' => $descriptionn, 'created' => $created]);
  }
  

  // Do any query in database

  public function query($query,$params){
    $stmt = $this->conn->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchall();
  }

  public function queryUnique($query,$params){
    $res = $this->query($query,$params);
    return reset($res);
  }
  
}


?>