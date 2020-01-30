<?php

require_once('header.php');

$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;



$titleSearchGet=$_GET['s'];
    if(strlen($titleSearchGet)<3){
        echo 'Folositi cel putin 3 caractere in campul de cautare!';
    } else{
        if(isset($titleSearchGet) && $titleSearchGet && $titleSearchGet !=""){
            function get_search_in_Title($value){
                global $titleSearchGet;
              if (strstr($value->title, strval($titleSearchGet))){
                 // echo 'dap';
                    return TRUE;
                }else{
                    return FALSE;
                }  
            }
            $titleSearchFiltered=array_filter(
                $movies,
                "get_search_in_Title"
            );
           
            if(count($titleSearchFiltered)>0){
            
               // $movie=$titleSearchFiltered; ?> 
                <br>
                Rezultatele cautarii pentru "<?php echo $titleSearchGet;?>" sunt:
                    
                    <?php  foreach($titleSearchFiltered as $movie){ ?>
             <pre>  <?php  echo($movie->title); ?> </pre> <?php
              } ?>
                   
                <?php
            }else{ ?>
                Niciun film nu a fost gasit. Cautati dupa alte caractere.
                <?php }
        }
    }
        ?>

   <?php require_once('footer.php')?>