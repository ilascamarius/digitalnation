<?php

require_once('header.php');

    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    ?>


       <?php
            $actorsAllList = array();
            $moviesRuntime = array();
           /*test commit*/
            $genreGet=ucfirst(strtolower($_GET['genre']));
            if(isset($genreGet) && $genreGet && $genreGet != ""){
            function get_movie_genre ($value){
                global $genreGet;
                if (in_array($genreGet, $value->genres)){
                    return TRUE;
                }else{
                    return FALSE;
                }
            }

            $moviesFiltrate=array_filter(
                $movies,
                "get_movie_genre"
            );

            if(count($moviesFiltrate)>0){
                $movies=$moviesFiltrate;
            }
        }

            foreach ($movies as $movie) {
               // if ($movie->year >= 2000) {
                    $moviesRuntime[] = $movie->runtime;
               // }


            }

            $moviesRuntimeMax=max($moviesRuntime);
            echo $moviesRuntimeMax;


           /* if(!isset($_COOKIE['longestMovieLength'])){
                setcookie('longestMovieLength', date('d.m.Y-H.i'), ($moviesRuntimeMax!=max($moviesRuntime)));
            } else {
                $moviesRuntimeMax = max($moviesRuntime);

            }
            echo $moviesRuntimeMax;*/

         ?>

    <?php require_once('archive-movie.php')?>
    <?php require_once('footer.php')?>
