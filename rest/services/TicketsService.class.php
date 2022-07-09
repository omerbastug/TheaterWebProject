<?php
require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/TicketsDao.class.php';

class TicketsService extends BaseService{

  public function __construct(){
    parent::__construct(new TicketsDao());
  }

  public function getBysessID($id){
    return $this->dao->getBysessID($id);
  }

  public function addticket($user, $entity){
    $params = ['sessid'=>$entity['session_id'],"seatrow"=>$entity["seatRow"],"seatcol"=>$entity["seatColumn"]];
    $ticket = $this->dao->getSpecific($params);
    if (isset($ticket[0]['id'])){
      throw new Exception("Seat Not Available");
    } else {
      $entity['personID'] = $user['id'];
      return parent::add($entity);
    }
  }
}
?>