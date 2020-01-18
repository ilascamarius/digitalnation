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
    }else{ ?>
        Nu exista acest film. Mergi <a href="archive.php"> inapoi la arhiva</a>.
        <?php }
    }
    ?>
    <h1>
<?php echo $movie->title;
?>
</h1>

<?php require_once('footer.php')?>