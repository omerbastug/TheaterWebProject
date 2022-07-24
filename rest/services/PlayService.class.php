<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/PlayDao.class.php';

class PlayService extends BaseService{

  public function __construct(){
    parent::__construct(new PlayDao());
  }

  public function favoritePlays($id){
      return $this->dao->favoritePlays($id);
  }

  public function addFavorite($user_id, $play_id){
    return $this->dao->addFavorite($user_id,$play_id);
  }
  public function deleteFavorite($user_id, $play_id){
    return $this->dao->deleteFavorite($user_id,$play_id);
  }

}
?>