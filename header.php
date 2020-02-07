<!DOCTYPE html>
<html lang="ro">
	<head>
		<meta charset="utf-8">
        <title>Filme</title>
        <link rel="stylesheet" type="text/css" href="style.css?version=54">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php  require_once('functions.php'); ?>
    </head>
	<body>

    <header>
        <div class="imageHeader">
<img src="images/movie.jpg" alt="Movie" width="100" height="150">
        </div>
        <div class="search-bar">
        <form class="example" action="search-results.php" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="s">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
</div>

<nav>
<ul>

<li>
    <a href="archive.php">Home</a>
</li>
    <li>
        <a href="archive.php">Movies</a>
    </li>
    <li>
        <a href="genres.php">Genres</a>
    </li>

    <li>
        <a href="">Contact</a>
    </li>
</ul>
</nav>

    </header>