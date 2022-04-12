<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TheatreDao.class.php';

class TheatreService extends BaseService{

  public function __construct(){
    parent::__construct(new TheatreDao());
  }

}
?>