<?php
require_once('header.php');

$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;

$movieId=$_GET['movie_id'];
if(isset($movieId) && $movieId && $movieId != ""){
    function get_movie ($value){
        global $movieId;
        if ($movieId == $value->id){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    $moviesFiltrate=array_filter(
        $movies,
        "get_movie",
        ARRAY_FILTER_USE_BOTH
    );

    if(count($moviesFiltrate)>0){
        $movie=reset($moviesFiltrate);
        echo $movie->title;

       
        print"<br/>";
       /* print"<pre>";
       if (db_connect()){
            print 'Conectat!';
        }else {
            print 'Eroare la conectare!';
        }
        print"</pre>";*/

      /* $tabel_filme= create_db_table_movies();

       if($tabel_filme){
           echo "Tabel filme creat";
       }else{
           echo "ERoare la creare tabel filme";
       }

       add_new_movie('Titanic', '7,8', '1998-03-06');*/

    }else{ ?>
        Nu exista acest film. Mergi <a href="archive.php"> inapoi la arhiva</a>.
        <?php }
    }
    ?>

<form  method="POST" action="">
<fieldset class="rating">
    <legend>Please rate:</legend>
    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Very good">5 stars</label>
    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Good">4 stars</label>
    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Medium">3 stars</label>
    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Bad">2 stars</label>
    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Very bad">1 star</label>

   

</fieldset>
<input type="submit" name="submit" value="Submit">
</form>
<?php

if(isset($_POST['submit'])) {
   // $rateValue=array();



   if ($_POST['rating']=='1'){
$rateValue=1;
   }

   if ($_POST['rating']=='2'){
    $rateValue=2;
       }

       if ($_POST['rating']=='3'){
        $rateValue=3;
           }

           if ($_POST['rating']=='4'){
            $rateValue=4;
               }

               if ($_POST['rating']=='5'){
                $rateValue=5;
                   }

    $data = $rateValue . "\r\n";
    $arrayData=array(
        $movie->id=> 
        $data);

        $jsontext='';
foreach($arrayData as $key=>$value){
    //$jsontext .="{Title: '".addslashes($key)."', Stars:'".addslashes($value)."'}," ;
    $jsontext .="ID: '".addslashes($key)."', Rating:'".addslashes($value)."'" ; 
    
}

$jsontext=substr_replace($jsontext, '',-1);
//$jsontext .="}";

$tabel_filme= create_db_table_movies();
add_new_movie($movie->id, $rateValue);

//echo 'test';
  
    $ret = file_put_contents('movies_rating.txt', $jsontext , FILE_APPEND | LOCK_EX);
    if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret bytes written to file";
        
    }
}
else {
   die('no post data to process');
} 


echo $jsontext;
json_encode($arrayData);
echo json_encode($arrayData);
json_encode('movies_rating.txt');

$avg_rating_movies=average_rating($movie->id);

echo($avg_rating_movies);
//echo 'test';


/* 
SELECT 
    AVG(rating) '$avg_rating'
FROM
    movies
WHERE
    id_movie = '$movie->id'; */


?>

<?php echo 'test'?>

<?php require_once('footer.php')?>