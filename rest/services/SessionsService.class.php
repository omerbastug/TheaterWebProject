<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/SessionsDao.class.php';

class SessionsService extends BaseService{

  public function __construct(){
    parent::__construct(new SessionsDao());
  }

}
?>