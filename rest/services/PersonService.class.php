<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/PersonDao.class.php';

class PersonService extends BaseService{

  public function __construct(){
    parent::__construct(new PersonDao());
  }
  public function isAperson($email){
    return $this->dao->isAperson($email);
  }
}
?>
