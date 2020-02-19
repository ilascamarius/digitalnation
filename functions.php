<?php

function db_connect($host='localhost', $username='cornel', $password='corneldn87', $dbname='rating'){
   
 return mysqli_connect($host, $username, $password, $dbname);
}

function create_db_table_movies(){

        $link=db_connect();
        $query="CREATE TABLE IF NOT EXISTS movies(id INT PRIMARY KEY AUTO_INCREMENT, id_movie DECIMAL, rating DECIMAL(5,2))";

  return  mysqli_query($link, $query);
}

function add_new_movie($id_movie, $rating){

$link=db_connect();

$query="INSERT INTO movies (id_movie, rating) VALUES('$id_movie', '$rating')";
    mysqli_query($link, $query);
}

function average_rating($movie_id){
    $link=db_connect();
    $query="SELECT AVG(rating) 'avg_rating' FROM movies WHERE id_movie = '$movie_id'; ";
    print_r($query) ;
    mysqli_query($link, $query);
    print_r(mysqli_query($link, $query)) ;
}

// https://www.mysqltutorial.org/mysql-avg/

?>