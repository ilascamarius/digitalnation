<?php

require_once('header.php');

$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;
?>
<div class="row genres">
<?php foreach ($genres as $genre){ ?>

    <a href="archive.php?genre=<?php echo $genre;?>" class="genre" style="background-color:#0882<?php echo rand(55,99);?>"> 
<?php echo $genre; ?>
</a>
    
<?php } ?>
</div>

    <?php require_once('footer.php')?>