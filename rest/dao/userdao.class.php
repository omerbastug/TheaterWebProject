<?php
require_once dirname(__FILE__)."/dao.class.php";
class userdao extends MoviesDao {


    public function getMoviesInDate($date){
        return $this->queryUnique("SELECT movieName FROM movieList WHERE datePublished = :date", ['date' => $date]);
    }

    public function getMoviesByName($name){
        return $this->queryUnique("SELECT * FROM movieList WHERE movieName = :name", ['name' => $name]);
    }
}

?>