<?php
require_once dirname(__FILE__)."/dao.class.php";
class userdao extends MoviesDao {


    public function getMoviesInDate($date){
        return $this->query("SELECT movieName FROM movieList WHERE datePublished = :date", ['date' => $date]);
    }
}

?>