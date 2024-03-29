<?php
ini_set("auto_detect_line_endings", true); // per il fine linea su MAC

require_once('utility.php');

use MieClassi\utility as UT;

$numeroParagrafi = 2;

$file = "index.json";
$arr = json_decode(UT ::leggiTesto($file));
$file1 = "nav_footer_index.json";
$nav = json_decode(UT ::leggiTesto($file1));
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $arr->titolo?></title>
    <link rel="stylesheet" href="css/style_index.min.css" type="text/css">
</head>
<body>
<img src="./Immagini/blue_elegante.jpg" alt="BG" width="100%" class="bg">

<!--BARRA DI NAVIGAZIONE------------------------------------------------------------------------------------------------------------------------------------------------------------>

    <header>
        <img src="Immagini/Logo%20Luca.png" alt="logo" width="180" class="logo">
        <nav>
            <ul class="menu">
                <?php
                    foreach ($nav->header as $link) {
                        printf('<li><a id="%s" href="%s" title="%s" >%s</a></li>' ,$link->id, $link->href, $link->title, $link->testo);
                    }
                ?>
           <!-- <li><a id="work" href="Work.html" title="Vai a Work">Work</a></li>
                <li><a id="port" href="Portfolio.html" title="Vai a Portfolio">Portfolio</a></li> -->
            </ul>
        </nav>
        <?php
            foreach ($nav->button as $link) {
                        printf('<div class="%s"><a  href="%s" title="%s" >%s</a></div>' ,$link->class, $link->href, $link->title, $link->testo);
                    }
        ?>
    </header>

<!--HOME---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <main>
            <!-- <video autoplay muted loop src="./Video/vecteezy.mp4" id="video"></video> -->
            <div class="presentazione">
                <h4 id="hello"><?php echo $arr->hello?></h4>
               <h1 id="hello2"><?php echo $arr->hello2?></h1>
            </div>
        <div class="button-1">
        <?php
            foreach ($nav->button1 as $link) {
                        printf('<div><a href="%s" title="%s" >%s</a></div>' ,$link->href, $link->title, $link->testo);
                    }
        ?>
        <!-- <div><a href="contatti.php" title="Vai a Contatti">Contattami per un Preventivo</a></div> -->
        </div>
        <div class="box">
            <h3><?php echo $arr->hello3?></h3>
            <img src="Immagini/coffee-cup-and-computer.jpg" alt="300px" class="img-home1">
                <?php for ($i = 0; $i < $numeroParagrafi; $i++) { ?>
                    <p class="lorem1">
                    <?php echo $arr->parag?>
                    </p>
                <?php } ?>
        </div>
    </main>   
        <div class="box2">
            <h3>I Servizi</h3>
            <h4>Web Marketing</h4>
            <p class="lorem2"> <?php echo $arr->par?>
            </p>
            <hr>
            <h4>Web Desing</h4>
            <p class="lorem2"> <?php echo $arr->par?>
            </p>
            <hr>
            <h4>SEO</h4>
            <p class="lorem2"> <?php echo $arr->par?>
            </p>
        </div>    

<!--FOOTER--------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <footer>
        <div class="container">
            <div class="footer-contenuto">
                <h3>Contact</h3>
                <!-- <ul class="contact"> -->
                    <?php
                        foreach ($nav->contatti as $link) {
                            if($link->href == 'null') {
                                    printf('<p>%s</p>' ,$link->testo);
                                } else {
                                    printf('<li><a href="%s" title="%s" >%s</a></li>' ,$link->href,$link->title,$link->testo);
                                }
                        }
                    ?> 
            </div>
            <div class="footer-contenuto">
                <h3 id="list">Quick Links</h3>
                <ul class="list">      
                <?php
                    foreach ($nav->footer as $link) {
                        printf('<li><a href="%s" title="%s" >%s</a></li>' ,$link->href, $link->title, $link->testo);
                    }
                ?>           
               <!-- <li><a href="work.php" title="Vai a Work">Work</a></li>
                    <li><a href="contatti.php" title="Vai a Contatti">Write Me</a></li>
                    <li><a href="portfolio.php" title="Vai a Portfolio">Portfolio</a></li> -->
            </ul>
            </div>
            <div class="footer-contenuto">
                <img src="Immagini/Logo%20Luca.png" alt="logo" width="180" class="logo2">
            </div>
        </div>
        <div class="bottom-bar">
            <p>&copy; 2023. All rights reserved</p>
        </div>
   </footer>
</body>
</html>