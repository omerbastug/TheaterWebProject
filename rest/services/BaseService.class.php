<?php
abstract class BaseService {

  protected $dao;

  public function __construct($dao){
    $this->dao = $dao;
  }

  public function getAllFromTable(){
    return $this->dao->getAllFromTable();
  }

  public function getByID($id){
    return $this->dao->getByID($id);
  }

  public function add($entity){
    return $this->dao->add($entity);
  }

  public function update($id, $entity){
    return $this->dao->update($id, $entity);
  }

  public function deleteByID($id){
    return $this->dao->deleteByID($id);
  }
}
?>
