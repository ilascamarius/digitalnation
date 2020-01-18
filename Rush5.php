<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <title>Curs 5 - Tema</title>
    <link rel="stylesheet" type="text/css" href="style.css?version=53">
</head>

<body>
    <?php
    /*
Mai jos găsiți un array cu mai multe filme.
1. Afișați pe pagină o listă neordonată cu toate filmele folosindu-vă de una dintre structurile repetitive: for, foreach, while
2. Afișați doar Titlul filmului, anul apariției și descrierea.
3. Titlurile filmelor afișați-le într-un tag header de nivelul 2
4. Faceți o interogare: Dacă anul filmului este mai mare sau ecal ca 2010, faceți afișarea anului bold
5. Faceți o interogare: Dacă filmul este mai vechi de 2000, NU includeți deloc acest film în afișarea noastră și treceți la următorul
6. Dacă descrierea (câmpul plot) este mai lungă de 100 de caractere, tăiați-o până la 100 de caractere și adăugați la sfârșit 3 puncte: ...

ADĂUGAT:
7. De acum înainte puteți să intercalați mai mult codul PHP cu cel HTML (vedeți mai jos exemplul meu) pentru ca pagina să prindă formă.
8. Creați un fișier style.css în același folder în care se afilă fișierul .php în care lucrați și includeți fișierul de stil aici. Folosiți fișierul de stiluri pentru a stiliza această pagină. Aplicați culori, mărimi de text etc.
9. Afișați în partea stângă posterul (lățime maximă 300px) iar în dreapta toate detaliile filmului.
10. Încercați să faceți conținutul responsive, în așa fel ca pe ecrane mai mici textul să cadă sub poster.
11. Afișați sub descriere lista cu genurile din care face parte acest film. Acestea să fie separate de virgulă (iar ultimul element să nu aibă virgulă la sfârșit)
12. Folosindu-vă de câmpul "runtime", înainte de toate găsiți cel mai lung film (adică găsiți și memorați valoarea cea mai mare de durată a filmului)
Ulterior, în dreptul fiecărui film faceți un Progress Bar (google it), adică o bară lungă gri, care să fie completată cu altă culoare pe atâtea procente din lungime, cât are ca durată filmul actual, raportat la cel mai lung film.
De exeplu cel mai lung film are 200 minute. Filmul actual are 140 minute. Durata de 140 reprezintă 70% din 200, respectiv bara va fi umplută la 70%
13. Bineînțeles că deasura barei sau sub ea afișați și durata filmului dar nu în minute ci în ore și minute. (exemplu: 135 minute vor fi afișate ca 2 ore, 15 minute)
14. Lista de actori, care este scrisă prin virgulă, spargeți-o într-un array și folosindu-vă de acesta, afișați actorii într-o listă ordonată (numerotată)
15. Colectați de la fiecare film actorii într-un array gol la început dar care se completează de la film la film, dar în așa fel ca același actor să nu se repete de mai multe ori
(puteți să filtrați în timp real actorii, atunci când îi adăugați în array sau la sfârșit să ștergeți dublurile).
16. După ce ați colectat toți actorii, faceți un sidebar pe partea dreaptă (folosindu-vă de HTML bineînțeles), și creați o categorie: "Toți actorii". Aceștia să fie ordonați alfabetic.
17. NU folosiți Bootstrap sau alte librării de pe net. Scrieți voi tot codul de la zero, fiecare linie de cod!
*/


    // Accesați acest link pentru a vedea lista originală cu toate filmele pe care am
    // folosit-o mai jos: https://github.com/yegor-sytnyk/movies-list/blob/master/db.json
    $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
    // DE AICI în jos rezolvați exercițiul
    //...

    //NOTĂ: Dacă nu vă place cum am stilizat codul, adică dacă vă sperie că atât de des închid codul
    // PHP și îl intercalez cu HTML, puteți să rezolvați exercițiul în stilul pe care l-am predat în Live-ul de la rush.
    // Important la afișare totul să funcționeze Dar și mai important este ca voi să puteți să deslușiți acest cod.

    //NOTĂ2: Codul din exemplul meu (de mai jos) este doar model ca să vedeți cum puteți stiliza codul altfel.
    // Dacă vreți să rezolvați exercițiul începând cu punctul 1, ștergeți tot ce am scris mai jos și luați-o de la capăt.
    // Dacă ați rezolvat deja punctele 1-6 dar aveți codul scris doar în PHP, puteți să investiți timp pentru a îl reface ca în exemplul de mai jos.
    // Dacă vă este lene, Dumnezeu vă vede (și îmi trimite mie statistici cu toți care ați trișat, le le trimit lui Moșu' și nu veți primi cadou de Crăciun).
    ?>

    <div class="row">
        <div class="column">
        <ul>
            <?php
            $actorsAllList = array();
            $moviesRuntime = array();
            /*  $moviesRuntime = array_column($movies, 'runtime', 'year');
           // print_r($moviesRuntime);


          echo "<pre>";
           print_r($moviesRuntime);
           echo "</pre>";

            $moviesRuntimeMax = max($moviesRuntime);
            echo $moviesRuntimeMax;*/

            foreach ($movies as $movie) {
                if ($movie->year >= 2000) {
                    $moviesRuntime[] = $movie->runtime;
                }
            }

            $moviesRuntimeMax = max($moviesRuntime);
            echo $moviesRuntimeMax;

            foreach ($movies as $movie) {

                // Atribuim variabilei $movie_year valoarea cu anul pentru a ne folosi de această variabilă ulterior
                $movie_year = $movie->year;

                // dacă anul filmului este mai mic de 2000, părăsim această repetare de foreach și trecem direct la următorul film. Dacă filmul e din 2000 sau mai nou, executăm codul de mai jos.
                if ($movie_year < 2000) continue;


                // Creăm variabila $plot cu descrierea filmului pentru a o folosi mai jos de câteva ori.
                $plot = $movie->plot;
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

                    <!-- <div class="posterAndDescription">-->

                    <div class="poster">
                        <?php
                            $posterAll = $movie->posterUrl;
                            //  $posterAll->setImageResolution(300, 300);
                            $imageData = base64_encode(file_get_contents($posterAll));
                            //$posterAll = $_GET['image'];
                            //$imageData->setImageResolution(300, 300);
                            echo '<img height="300" width="300" src="data:image/jpeg;base64,' . $imageData . '">';
                        ?>
                        <!-- </div>-->

                        <!-- <div class="description">-->
                        <?php
                            // dacă lungimea descrierii este mai mare de 100 simboluri, o tăiem până la 100 și afișăm ..., în caz contrar pur și simplu afișăm descrierea întreagă
                            if (strlen($plot) > 100) {
                                echo substr($plot, 0, 100) . "...";
                            } else {
                                echo $plot;
                            }
                        ?>
                    </div>
                    <!--  </div>-->

                    <div class="genuri">

                        <?php

                            $genresList = rtrim(implode(',', $movie->genres), ',');
                            echo $genresList;
                        ?>
                    </div>

                    <!-- <div class="poster">
                        <?php
                            /* $posterAll = $movie->posterUrl;
                            $imageData = base64_encode(file_get_contents($posterAll));
                            //$posterAll = $_GET['image'];
                            echo '<img src="data:image/jpeg;base64,' . $imageData . '">';*/
                        ?>

                    </div>-->

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
                            <div class="" style="width: <?php echo $movie->runtime * 100 / $moviesRuntimeMax; ?>%">

                            </div>
                        </div>
                    </div>

                    <div class="runtimeDisplay">
                        <?php
                        $runtimeDisplay=$movie->runtime;
                        //echo $runtimeDisplay;
                        echo date('H:i', mktime(0, $runtimeDisplay));
                        ?>

                </li>
            <?php } ?>
        </ul>
        </div>
        <div class="column">
            <div class="fixed-sidebar-text">

                <ul>
                    <?php
                                                    $actorsAllListCleaned = array_unique($actorsAllList);
                                                    //print_r($actorsAllListCleaned); 
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

</body>

</html>