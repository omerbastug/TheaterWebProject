<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/PlayDao.class.php';

class PlayService extends BaseService{

  public function __construct(){
    parent::__construct(new PlayDao());
  }

}
?>