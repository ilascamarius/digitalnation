<?php

require_once('header.php');
  
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    ?>

    <div class="row">
        <div class="column">
        <ul>
            <?php
         
            foreach ($movies as $movie) {
                    $moviesRuntime[] = $movie->runtime;
            }

            foreach ($movies as $movie) {

                $movie_year = $movie->year;
                   $plot = $movie->plot;

                $regizor=$movie->director;

            ?>
                <li>

                    <h2> <?php echo $movie->title; ?></h2>

                    <?php if ($movie_year >= 2010) { ?>
                        <strong>
                            <?php echo $movie->year ?>
                        </strong>
                    <?php } else {
                                echo $movie->year;
                            } ?>

                    <div class="poster">
                        <?php
                            $posterAll = $movie->posterUrl;
                
                            $file_headers=@get_headers($posterAll);
                            if(!$file_headers || $file_headers[0]=='HTTP/1.1 404 Not Found' || $file_headers[0]=='Not Found' || (strpos($file_headers[0], '403'))){
                                $exists=false;
                            }
                            else{
                                $exists=true;
                            }
                                
                            if ($exists) {
                                $imageData = base64_encode(file_get_contents($posterAll));
                               echo '<img width="300" src="data:image/jpeg;base64,' . $imageData . '">';
                           }else{
                               echo '<img width="300" src="https://upload.wikimedia.org/wikipedia/commons/0/04/NoDVDCover.svg">';
                           }
                
                        ?>
                        <?php echo $plot;?>
                    </div>

                    <div class="genuri">

                        <?php

                            $genresList = rtrim(implode(',', $movie->genres), ',');
                            echo $genresList;
                        ?>
                    </div>
                                <div class="regizori">
                                    <?php
                                    if ($regizor!="N/A"){
                                    echo $regizor;
                                    }
                                    ?>

                            </div>

                    <div class="actori">
                        <ol>
                            <?php
                            $actors = $movie->actors;
                            $actorsArr = explode(',', $actors);
                            for ($actorsIncrement = 0; $actorsIncrement < count($actorsArr); $actorsIncrement++) {

                                $actorsAllList[] = $actorsArr[$actorsIncrement];
                            ?>
                                <li>
                                    <?php echo $actorsArr[$actorsIncrement]; ?>
                                </li>
                            <?php
                                }
                            ?>
                        </ol>
                    </div>

                    <div class="runtime-bar">
                        <div class="">
                            <div class="" style=width:<?php echo $movie->runtime * 100 / $moviesRuntimeMax;?>%>

                            </div>
                        </div>
                    </div>

                    <div class="runtimeDisplay">
                        <?php
                        $runtimeDisplay=$movie->runtime;

                        echo date('H:i', mktime(0, $runtimeDisplay));
                        ?>
                            <br>
                        <a href="movie.php?movie_id=<?php echo $movie->id; ?>">Mai multe detalii</a>

                </li>
            <?php } ?>
        </ul>
        </div>
        <div class="column">
            <div class="fixed-sidebar-text">

                <ul>
                    <?php
                                                    $actorsAllListCleaned = array_unique($actorsAllList);
                                                    sort($actorsAllListCleaned);
                                                    foreach ($actorsAllListCleaned as $actor) {
                    ?>
                        <li>
                            <?php echo $actor ?>
                        </li>
                    <?php
                                                    }

                    ?>
                </ul>
            </div>
        </div>
    </div>

    <?php require_once('footer.php')?>