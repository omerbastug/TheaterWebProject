<?php
require_once __DIR__."/BaseDao.class.php";

class PlayDao extends BaseDao {
    public function __construct(){
        parent::__construct("play");
    }
    
    public function favoritePlays($id){
        $stmt = $this->conn->prepare("SELECT play_id FROM favoriteplay WHERE person_id = :id ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function addFavorite($user_id,$play_id){
        $stmt = $this->conn->prepare("INSERT INTO favoriteplay
        (person_id, 
        play_id
        )
        VALUES
        ( :user_id , 
        :play_id
        );
    ");
        $stmt->execute(['user_id' => $user_id, 'play_id' => $play_id]);
    }

    public function deleteFavorite($user_id,$play_id){
        $stmt = $this->conn->prepare("DELETE FROM favoriteplay
        WHERE
	    `person_id` = :user_id AND `play_id` = :play_id");
        $stmt->execute(['user_id' => $user_id, 'play_id' => $play_id]);
    }
}
?>